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
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Baik',
            'birth_date' => '2000-01-01',
            'email' => 'admin@email.com',
            'whatsapp' => '081234567890',
            'password' => Hash::make('test1234'),
            'role_id' => 1,
        ]);

        User::create([
            'first_name' => 'Mentor',
            'last_name' => 'Baik',
            'birth_date' => '2000-01-01',
            'email' => 'mentor@email.com',
            'whatsapp' => '081234567890',
            'course_id' => 1,
            'password' => Hash::make('test1234'),
            'role_id' => 2,
        ]);

        $student = User::create([
            'first_name' => 'Student',
            'last_name' => 'Baik',
            'birth_date' => '2000-01-01',
            'email' => 'student@email.com',
            'whatsapp' => '081234567890',
            'password' => Hash::make('test1234'),
            'role_id' => 3,
            'course_id' => 1,
        ]);

        $batch = Batch::first();
        if ($batch) {
            Enrollment::create([
                'user_id' => $student->id,
                'batch_id' => $batch->id,
                'status' => 'active'
            ]);
        }
    }
}
