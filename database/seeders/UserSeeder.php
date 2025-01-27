<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use App\Models\Batch;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        // Admin
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Baik',
            'birth_date' => '1990-05-15',
            'email' => 'admin@email.com',
            'whatsapp' => '081234567890',
            'password' => Hash::make('test1234'),
            'role_id' => 1,
            'is_active' => true,
            'profile_image' => null,
            'bio' => 'Administrator EduBridge dengan pengalaman 5+ tahun dalam manajemen pendidikan. Berkomitmen untuk memastikan kualitas pembelajaran terbaik untuk semua pengguna platform.'
        ]);

        // Mentor Data Science
        User::create([
            'first_name' => 'Dewi',
            'last_name' => 'Kusuma',
            'birth_date' => '1988-08-20',
            'email' => 'mentor@email.com',
            'whatsapp' => '081345678901',
            'course_id' => 1,
            'preferred_course' => 1,
            'password' => Hash::make('test1234'),
            'role_id' => 2,
            'is_active' => true,
            'profile_image' => null,
            'bio' => 'Data Scientist dengan pengalaman 8 tahun di berbagai perusahaan teknologi. Passionate dalam mengajar dan berbagi pengetahuan tentang AI dan Machine Learning.',
            'education_background' => 'S2 Teknik Informatika ITB, S1 Matematika UI'
        ]);

        $batch = Batch::first();

        $student1 = User::create([
            'first_name' => 'Siti',
            'last_name' => 'Rahayu',
            'birth_date' => '2000-12-25',
            'email' => 'student@email.com',
            'whatsapp' => '081567890123',
            'password' => Hash::make('test1234'),
            'role_id' => 3,
            'course_id' => 1,
            'is_active' => true,
            'profile_image' => null,
        ]);

        Enrollment::create([
            'user_id' => $student1->id,
            'batch_id' => $batch->id
        ]);

        // Generate 10 students for each course
        $courses = Course::all();

        foreach ($courses as $course) {
            // Generate 10 students for this course
            for ($i = 1; $i <= 10; $i++) {
                $student = User::factory()->create([
                    'role_id' => 3, // Student role
                    'course_id' => $course->id,
                    'is_active' => true,
                    'email' => "student{$course->id}_{$i}@edubridge.test",
                    'password' => Hash::make('student123'),
                    'bio' => fake()->realText(200),
                    'profession' => fake()->jobTitle(),
                    'reason' => fake()->realText(150)
                ]);

                // Create enrollment for the student
                if ($batch) {
                    Enrollment::create([
                        'user_id' => $student->id,
                        'batch_id' => $batch->id
                    ]);
                }
            }
        }
    }
}
