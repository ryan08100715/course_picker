<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'name' => '程式設計基礎',
                'description' => '學習 Python 和基礎編程',
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'instructor_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '網頁開發入門',
                'description' => 'HTML, CSS 和 JavaScript 基礎',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'instructor_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '資料庫管理',
                'description' => 'SQL 和資料庫設計',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'instructor_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '進階 PHP 課程',
                'description' => 'Laravel 框架實務',
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
                'instructor_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '機器學習概論',
                'description' => '介紹 AI 和機器學習概念',
                'start_time' => '15:00:00',
                'end_time' => '17:00:00',
                'instructor_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Course::insert($courses);
    }
}
