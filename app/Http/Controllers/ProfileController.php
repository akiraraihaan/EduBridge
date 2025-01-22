<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            try {
                $file = $request->file('profile_image');

                // Validate file
                if (!$file->isValid()) {
                    throw new \Exception('File upload failed');
                }

                // Delete old image if exists
                if ($user->profile_image && Storage::disk('public')->exists('avatars/' . $user->profile_image)) {
                    Storage::disk('public')->delete('avatars/' . $user->profile_image);
                }

                // Generate unique filename
                $extension = $file->getClientOriginalExtension();
                $filename = 'avatar_' . time() . '_' . Str::random(10) . '.' . $extension;

                // Move file to storage using move method
                $file->move(storage_path('app/public/avatars'), $filename);

                // Save filename to database
                $user->profile_image = $filename;

            } catch (\Exception $e) {
                Log::error('Profile image upload failed: ' . $e->getMessage());
                return back()->withErrors(['profile_image' => 'Gagal mengupload foto profil: ' . $e->getMessage()]);
            }
        }

        $user->fill($request->safe()->except(['profile_image']));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        try {
            $user->save();
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            Log::error('Profile update failed: ' . $e->getMessage());
            return back()->withErrors(['profile_image' => 'Gagal menyimpan profil: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete profile image if exists
        if ($user->profile_image && Storage::disk('public')->exists('avatars/' . $user->profile_image)) {
            Storage::disk('public')->delete('avatars/' . $user->profile_image);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Remove the user's profile photo.
     */
    public function removePhoto(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->profile_image && Storage::disk('public')->exists('avatars/' . $user->profile_image)) {
            // Delete file from storage
            Storage::disk('public')->delete('avatars/' . $user->profile_image);

            // Update database
            $user->forceFill([
                'profile_image' => null
            ])->save();
        }

        return Redirect::route('profile.edit')->with('status', 'photo-removed');
    }
}
