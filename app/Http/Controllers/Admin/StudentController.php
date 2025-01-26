<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Batch;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $activeBatch = Batch::where('is_active', true)->first();

        if (!$activeBatch) {
            return view('admin.students.index', ['courses' => collect()]);
        }

        // Ambil semua course yang aktif
        $courses = Course::where('is_active', true)
            ->with(['modules.assignments.submissions' => function($query) use ($activeBatch) {
                $query->whereHas('student', function($q) use ($activeBatch) {
                    $q->whereHas('enrollments', function($eq) use ($activeBatch) {
                        $eq->where('batch_id', $activeBatch->id)
                            ->where('status', 'active');
                    });
                })->whereNotNull('score'); // Hanya submission yang sudah dinilai
            }])
            ->get();

        // Untuk setiap course, ambil student dengan nilai rata-rata
        foreach ($courses as $course) {
            $students = User::where('role_id', 3) // role student
                ->where('course_id', $course->id)
                ->whereHas('enrollments', function($query) use ($activeBatch) {
                    $query->where('batch_id', $activeBatch->id)
                        ->where('status', 'active');
                })
                ->withCount(['submissions as average_score' => function($query) {
                    $query->select(DB::raw('coalesce(avg(score),0)'))
                        ->whereNotNull('score');
                }])
                ->orderByDesc('is_active') // Urutkan berdasarkan status aktif terlebih dahulu
                ->orderByDesc('average_score')
                ->get();

            $course->students = $students;
        }

        return view('admin.students.index', compact('courses'));
    }

    public function toggleStatus(Request $request, User $student)
    {
        if (!$student->isStudent()) {
            return back()->with('error', 'User bukan merupakan student');
        }

        $student->is_active = !$student->is_active;
        $student->save();

        // Update status enrollment jika ada
        $student->enrollments()
            ->where('status', 'active')
            ->update([
                'status' => $student->is_active ? 'active' : 'dropped'
            ]);

        $status = $student->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Student berhasil {$status}");
    }
}
