<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User::create([
            // $table->id();
            // $table->string('first_name');
            // $table->string('last_name');
            // $table->date('birth_date');
            // $table->string('email')->unique();
            // $table->string('whatsapp');
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->unsignedBigInteger('role_id');
            // $table->foreign('role_id')->references('id')->on('roles');
            // $table->boolean('is_active')->default(true);
            // $table->string('profile_image')->nullable();
            // $table->text('bio')->nullable();

            // // Student fields
            // $table->string('profession')->nullable();
            // $table->foreignId('course_id')->nullable()->constrained();
            // $table->text('reason')->nullable();
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
                'password' => Hash::make('test1234'),
                'role_id' => 2,
            ]);
            User::create([
                'first_name' => 'Student',
                'last_name' => 'Baik',
                'birth_date' => '2000-01-01',
                'email' => 'student@email.com',
                'whatsapp' => '081234567890',
                'password' => Hash::make('test1234'),
                'role_id' => 3,
            ]);
    }
}
