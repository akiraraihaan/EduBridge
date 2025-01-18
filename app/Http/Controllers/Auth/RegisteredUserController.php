<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $role = request()->query('role', 'student');
        return view('auth.register', ['defaultRole' => $role]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            // Jika registrasi sebagai student, cek apakah ada batch yang aktif dan terbuka
            if ($request->role_id == 3) {
                $activeBatch = \App\Models\Batch::where('is_active', true)
                    ->where('is_open', true)
                    ->first();

                if (!$activeBatch) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Pendaftaran student saat ini sedang ditutup.'
                        ], 422);
                    }
                    return back()
                        ->withInput()
                        ->with('error', 'Pendaftaran student saat ini sedang ditutup.');
                }

                // Cek apakah batch masih memiliki slot
                if (!$activeBatch->hasAvailableSlots()) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Batch saat ini sudah penuh.'
                        ], 422);
                    }
                    return back()
                        ->withInput()
                        ->with('error', 'Batch saat ini sudah penuh.');
                }
            }

            // Cek apakah email sudah terdaftar (terlepas dari role)
            $existingUser = User::where('email', $request->email)->first();
            if ($existingUser) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'errors' => [
                            'email' => ['Email ini sudah terdaftar. Silakan gunakan email lain.']
                        ]
                    ], 422);
                }
                return back()
                    ->withInput()
                    ->withErrors(['email' => 'Email ini sudah terdaftar. Silakan gunakan email lain.'])
                    ->with('error_type', 'email');
            }

            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'birth_date' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) use ($request) {
                        $age = Carbon::parse($value)->age;

                        if ($request->role_id == 3 && ($age < 17 || $age > 30)) {
                            $fail('Usia untuk student harus antara 17-30 tahun.');
                        }

                        if ($request->role_id == 2 && $age < 17) {
                            $fail('Usia untuk mentor minimal 17 tahun.');
                        }
                    },
                ],
                'email' => ['required', 'string', 'email', 'max:255'],
                'whatsapp' => ['required', 'string', 'max:255'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role_id' => ['required', 'in:2,3'],

                // Student validation
                'profession' => ['required_if:role_id,3', 'nullable', 'string', 'max:255'],
                'course_id' => ['required_if:role_id,3', 'nullable', 'exists:courses,id'],
                'reason' => ['required_if:role_id,3', 'nullable', 'string'],

                // Mentor validation
                'education_background' => ['required_if:role_id,2', 'nullable', 'string'],
                'certifications_file' => [
                    'required_if:role_id,2',
                    'nullable',
                    'file',
                    'mimes:pdf',
                    'max:2048'
                ],
                'preferred_course' => ['required_if:role_id,2', 'nullable', 'exists:courses,id'],
            ]);

            // Set data dasar user
            $userData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->birth_date,
                'email' => $request->email,
                'whatsapp' => $request->whatsapp,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'is_active' => $request->role_id == 3, // Student langsung aktif, mentor perlu approval admin
            ];

            $user = User::create($userData);

            // Jika student, simpan data student
            if ($request->role_id == 3) {
                $user->update([
                    'profession' => $request->profession,
                    'course_id' => $request->course_id,
                    'reason' => $request->reason,
                ]);

                // Cari batch yang aktif dan terbuka
                $activeBatch = \App\Models\Batch::where('is_active', true)
                    ->where('is_open', true)
                    ->first();

                if ($activeBatch) {
                    // Buat enrollment untuk student ke batch yang aktif
                    \App\Models\Enrollment::create([
                        'user_id' => $user->id,
                        'batch_id' => $activeBatch->id,
                        'status' => 'active'
                    ]);
                }
            }

            // Jika mentor, simpan data mentor
            if ($request->role_id == 2) {
                // Upload file sertifikasi
                if ($request->hasFile('certifications_file')) {
                    $path = $request->file('certifications_file')->store('certifications', 'public');
                }

                $user->update([
                    'education_background' => $request->education_background,
                    'certifications_file' => $path ?? null,
                    'preferred_course' => $request->preferred_course,
                ]);
            }

            event(new Registered($user));

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Registrasi berhasil! Silakan login dengan akun Anda.'
                ]);
            }

            return redirect()->route('login')
                ->with('success', 'Akun telah berhasil dibuat! Silakan login dengan akun Anda.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }
}
