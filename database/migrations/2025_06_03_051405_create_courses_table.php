<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
            $table->foreignId('instructor_id')->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
