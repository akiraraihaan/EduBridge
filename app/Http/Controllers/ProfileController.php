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

                // Log file info
                \Log::info('Uploading profile image:', [
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize()
                ]);

                // Delete old image if exists
                if ($user->profile_image) {
                    \Log::info('Deleting old image: ' . $user->profile_image);
                    Storage::disk('public')->delete($user->profile_image);
                }

                // Store new image
                $path = $file->store('profile-photos', 'public');
                \Log::info('New image stored at: ' . $path);

                // Update user profile_image
                $user->profile_image = $path;

                // Verify file exists
                if (!Storage::disk('public')->exists($path)) {
                    throw new \Exception('File not stored correctly');
                }

                \Log::info('File exists check passed');

            } catch (\Exception $e) {
                \Log::error('Error uploading profile image: ' . $e->getMessage());
                return back()->withErrors(['profile_image' => 'Gagal mengupload foto profil: ' . $e->getMessage()]);
            }
        }

        $user->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->save();

        // Log final profile image path
        \Log::info('Final profile image path: ' . $user->profile_image);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
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

        if ($user->profile_image) {
            // Delete file if exists
            Storage::disk('public')->delete($user->profile_image);

            // Update database
            $user->forceFill([
                'profile_image' => null
            ])->save();
        }

        return Redirect::route('profile.edit')->with('status', 'photo-removed');
    }
}
