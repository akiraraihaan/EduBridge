<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'name' => 'Front End',
                'description' => 'Belajar pengembangan web front-end dengan HTML, CSS, JavaScript, dan React',
                'image' => '/img/course-1.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true
            ],
            [
                'name' => 'Back End',
                'description' => 'Belajar pengembangan web back-end dengan PHP, Laravel, dan MySQL',
                'image' => '/img/course-2.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true
            ],
            [
                'name' => 'Data Science',
                'description' => 'Belajar data science dengan Python, Pandas, dan Machine Learning',
                'image' => '/img/course-4.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Belajar desain UI/UX dengan Figma dan prinsip desain modern',
                'image' => '/img/course-3.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true
            ],
            [
                'name' => 'Social Media Strategy',
                'description' => 'Belajar strategi media sosial dan digital marketing',
                'image' => '/img/course-1.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true
            ],
            [
                'name' => 'Digital Marketing',
                'description' => 'Belajar digital marketing komprehensif dan strategi pemasaran online',
                'image' => '/img/course-1.png',
                'duration_months' => 12,
                'max_students' => 166,
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'is_active' => true
            ]
        ];

        foreach ($courses as $course) {
            DB::table('courses')->insert($course);
        }
    }
}
