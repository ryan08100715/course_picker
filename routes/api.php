<?php

Route::get('/courses', fn () => '取得所有課程資訊');
Route::post('/courses', fn () => '新增課程');
Route::put('/courses/{course}', fn () => '更新課程資訊');
Route::delete('/courses/{course}', fn () => '刪除課程');

Route::get('/instructors', fn () => '取得所有講師資訊');
Route::post('/instructors', fn () => '新增講師');
Route::get('/instructors/{instructor}/courses', fn () => '取得某位講師的開課資訊');
