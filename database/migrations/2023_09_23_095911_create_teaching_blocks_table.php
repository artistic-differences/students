<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teaching_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_class_id')->constrained('teacher_classes');
            $table->integer('day_of_week');
            $table->integer('block_start');
            $table->integer('block_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_blocks');
    }
};
