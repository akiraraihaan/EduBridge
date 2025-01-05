<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('batch_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['active', 'graduated', 'dropped'])->default('active');
            $table->float('current_score')->default(0);
            $table->integer('assignments_completed')->default(0);
            $table->timestamp('last_activity')->nullable();
            $table->timestamps();

            // Satu user hanya bisa enroll di satu batch aktif
            $table->unique(['user_id', 'batch_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
};
