<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('email')->unique();
            $table->string('whatsapp');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('role_id')->constrained();
            $table->boolean('is_active')->default(true);
            $table->string('profile_image')->nullable();
            $table->text('bio')->nullable();

            // Student fields
            $table->string('profession')->nullable();
            $table->foreignId('course_id')->nullable()->constrained();
            $table->text('reason')->nullable();

            // Mentor fields
            $table->text('education_background')->nullable();
            $table->string('certifications_file')->nullable();
            $table->foreignId('preferred_course')->nullable()->constrained('courses');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
