<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\MentorController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CertificateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Mentor\DashboardController as MentorDashboardController;
use App\Http\Controllers\Mentor\ProfileController as MentorProfileController;
use App\Http\Controllers\Mentor\MaterialController as MentorMaterialController;
use App\Http\Controllers\Mentor\ModuleController as MentorModuleController;
use App\Http\Controllers\Mentor\AssignmentController as MentorAssignmentController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\MaterialController as StudentMaterialController;
use App\Http\Controllers\Student\AssignmentController as StudentAssignmentController;

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
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::put('/students/{student}/toggle-status', [StudentController::class, 'toggleStatus'])->name('students.toggle-status');
    Route::resource('certificates', CertificateController::class)->except(['edit', 'update', 'show']);
});

// Mentor Routes
Route::middleware(['auth', 'verified', 'role:mentor'])->prefix('mentor')->name('mentor.')->group(function () {
    Route::get('/', [MentorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [MentorProfileController::class, 'index'])->name('profile');
    Route::resource('modules', MentorModuleController::class);
    Route::resource('materials', MentorMaterialController::class);
    Route::resource('assignments', MentorAssignmentController::class);
    Route::put('assignments/submissions/{submission}/grade', [MentorAssignmentController::class, 'gradeSubmission'])->name('assignments.submissions.grade');
});

// Student Routes
Route::middleware(['auth', 'verified', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [StudentProfileController::class, 'index'])->name('profile');
    Route::get('/materials', [StudentMaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/{material}', [StudentMaterialController::class, 'show'])->name('materials.show');
    Route::get('/materials/{material}/download', [StudentMaterialController::class, 'download'])->name('materials.download');
    Route::get('/assignments', [StudentAssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/{assignment}', [StudentAssignmentController::class, 'show'])->name('assignments.show');
    Route::post('/assignments/{assignment}/submit', [StudentAssignmentController::class, 'submit'])->name('assignments.submit');
    Route::get('/assignments/{assignment}/submissions/{submission}', [StudentAssignmentController::class, 'showSubmission'])->name('assignments.submissions.show');
});

// Dashboard route that redirects based on role middleware
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard')->middleware(['role:admin,mentor,student']);
});

// Add certificate routes for student and mentor
Route::middleware(['auth'])->group(function () {
    Route::get('/certificates', function () {
        $certificates = Auth::user()->certificates;
        return view('certificates.index', compact('certificates'));
    })->name('certificates.index');
});

require __DIR__.'/auth.php';
