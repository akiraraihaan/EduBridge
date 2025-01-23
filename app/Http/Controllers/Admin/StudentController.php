<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        // Ambil semua course yang aktif
        $courses = Course::where('is_active', true)
            ->with(['modules.assignments.submissions' => function($query) {
                $query->whereNotNull('score'); // Hanya submission yang sudah dinilai
            }])
            ->get();

        // Untuk setiap course, ambil student dengan nilai rata-rata
        foreach ($courses as $course) {
            $students = User::where('role_id', 3) // role student
                ->where('course_id', $course->id)
                ->where('is_active', true)
                ->withCount(['submissions as average_score' => function($query) {
                    $query->select(DB::raw('coalesce(avg(score),0)'))
                        ->whereNotNull('score');
                }])
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
        if ($student->enrollment) {
            $student->enrollment->update([
                'status' => $student->is_active ? 'active' : 'dropped'
            ]);
        }

        $status = $student->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Student berhasil {$status}");
    }
}
