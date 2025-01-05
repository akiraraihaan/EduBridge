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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
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
                'max:2048' // maksimal 2MB
            ],
            'preferred_course' => ['required_if:role_id,2', 'nullable', 'exists:courses,id'],
        ]);

        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'is_active' => true,
        ];

        $user = User::create($userData);

        // Jika student, simpan data student
        if ($request->role_id == 3) {
            $user->update([
                'profession' => $request->profession,
                'course_id' => $request->course_id,
                'reason' => $request->reason,
            ]);
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

        return redirect()->route('login')
            ->with('status', 'Registrasi berhasil! Silakan login dengan akun Anda.');
    }
}
