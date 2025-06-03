<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;

Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::put('/courses/{course}', [CourseController::class, 'update']);
Route::delete('/courses/{course}', [CourseController::class, 'destroy']);

Route::get('/instructors', [InstructorController::class, 'index']);
Route::post('/instructors', [InstructorController::class, 'store']);
Route::get('/instructors/{instructor}/courses', [InstructorController::class, 'courseIndex']);
