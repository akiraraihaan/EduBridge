<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;

class TopPerformerController extends Controller
{
    public function index()
    {
        // Ambil semua course yang aktif
        $courses = Course::where('is_active', true)
            ->with(['modules.assignments.submissions' => function($query) {
                $query->whereNotNull('score'); // Hanya submission yang sudah dinilai
            }])
            ->get();

        // Untuk setiap course, ambil top 5 student dengan nilai rata-rata tertinggi
        foreach ($courses as $course) {
            $topStudents = User::where('role_id', 3) // role student
                ->where('course_id', $course->id)
                ->where('is_active', true)
                ->withCount(['submissions as average_score' => function($query) {
                    $query->select(DB::raw('coalesce(avg(score),0)'))
                        ->whereNotNull('score');
                }])
                ->orderByDesc('average_score')
                ->take(5)
                ->get();

            $course->top_students = $topStudents;
        }

        return view('admin.top-performers.index', compact('courses'));
    }

    public function export()
    {
        // Persiapkan data untuk ekspor
        $courses = Course::where('is_active', true)->get();
        $csvData = [];

        // Header untuk CSV
        $csvData[] = [
            'Course',
            'Rank',
            'Student Name',
            'Email',
            'WhatsApp',
            'Average Score'
        ];

        foreach ($courses as $course) {
            $topStudents = User::where('role_id', 3)
                ->where('course_id', $course->id)
                ->where('is_active', true)
                ->withCount(['submissions as average_score' => function($query) {
                    $query->select(DB::raw('coalesce(avg(score),0)'))
                        ->whereNotNull('score');
                }])
                ->orderByDesc('average_score')
                ->take(5)
                ->get();

            $rank = 1;
            foreach ($topStudents as $student) {
                $csvData[] = [
                    $course->name,
                    $rank,
                    $student->first_name . ' ' . $student->last_name,
                    $student->email,
                    $student->whatsapp,
                    number_format($student->average_score, 2)
                ];
                $rank++;
            }
        }

        // Buat CSV
        $csv = Writer::createFromString('');
        $csv->insertAll($csvData);

        // Set header untuk download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="top_performers.csv"',
        ];

        return response($csv->toString(), 200, $headers);
    }
}
