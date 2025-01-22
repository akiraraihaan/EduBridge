<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Mentor\DashboardController as MentorDashboardController;
use App\Http\Controllers\Mentor\ProfileController as MentorProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\MentorController;
use App\Http\Controllers\Mentor\MaterialController as MentorMaterialController;
use App\Http\Controllers\Student\MaterialController as StudentMaterialController;
use App\Http\Controllers\Student\ModuleController as StudentModuleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [GuestController::class, 'welcoming'])->name('home');

// About Us Route
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/photo', [ProfileController::class, 'removePhoto'])->name('profile.remove-photo');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::resource('batches', BatchController::class);
    Route::post('batches/{batch}/toggle-status', [BatchController::class, 'toggleStatus'])->name('batches.toggle-status');
    Route::post('batches/{batch}/toggle-registration', [BatchController::class, 'toggleRegistration'])->name('batches.toggle-registration');
    Route::get('/mentors', [MentorController::class, 'index'])->name('mentors.index');
    Route::put('/mentors/{mentor}/activate', [MentorController::class, 'activate'])->name('mentors.activate');
    Route::put('/mentors/{mentor}/deactivate', [MentorController::class, 'deactivate'])->name('mentors.deactivate');
});

// Mentor Routes
Route::middleware(['auth', 'verified', 'role:mentor'])->prefix('mentor')->name('mentor.')->group(function () {
    Route::get('/', [MentorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [MentorProfileController::class, 'index'])->name('profile');
    Route::resource('modules', \App\Http\Controllers\Mentor\ModuleController::class);
    Route::resource('materials', \App\Http\Controllers\Mentor\MaterialController::class);
});

// Student Routes
Route::middleware(['auth', 'verified', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [StudentProfileController::class, 'index'])->name('profile');
    Route::get('/modules', [StudentModuleController::class, 'index'])->name('modules.index');
    Route::get('/modules/{module}', [StudentModuleController::class, 'show'])->name('modules.show');
    Route::get('/materials/{material}', [StudentMaterialController::class, 'show'])->name('materials.show');
    Route::get('/materials/{material}/download', [StudentMaterialController::class, 'download'])->name('materials.download');
});

// Dashboard route that redirects based on role middleware
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard')->middleware(['role:admin,mentor,student']);
});

require __DIR__.'/auth.php';
