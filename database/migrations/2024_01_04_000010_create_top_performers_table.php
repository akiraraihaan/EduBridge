<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('top_performers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('batch_id')->constrained()->onDelete('cascade');
            $table->float('final_score');
            $table->integer('rank');
            $table->text('achievement_note')->nullable();
            $table->timestamps();

            // Satu user hanya bisa menjadi top performer sekali per batch
            $table->unique(['user_id', 'batch_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('top_performers');
    }
};
