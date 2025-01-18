<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::truncate();

        $courses = [
            [
                'name' => 'Front End',
                'description' => 'Belajar pengembangan web front-end dengan HTML, CSS, JavaScript, dan React',
                'image' => '/img/course-1.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true,
                'student_count' => 0
            ],
            [
                'name' => 'Back End',
                'description' => 'Belajar pengembangan web back-end dengan PHP, Laravel, dan MySQL',
                'image' => '/img/course-2.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true,
                'student_count' => 0
            ],
            [
                'name' => 'Data Science',
                'description' => 'Belajar data science dengan Python, Pandas, dan Machine Learning',
                'image' => '/img/course-4.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true,
                'student_count' => 0
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Belajar desain UI/UX dengan Figma dan prinsip desain modern',
                'image' => '/img/course-3.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true,
                'student_count' => 0
            ],
            [
                'name' => 'Social Media Strategy',
                'description' => 'Belajar strategi media sosial dan digital marketing',
                'image' => '/img/course-1.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true,
                'student_count' => 0
            ],
            [
                'name' => 'Digital Marketing',
                'description' => 'Belajar digital marketing komprehensif dan strategi pemasaran online',
                'image' => '/img/course-1.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true,
                'student_count' => 0
            ]
        ];

        foreach ($courses as $course) {
            DB::table('courses')->insert($course);
        }
    }
}
