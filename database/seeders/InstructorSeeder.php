<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstructorSeeder extends Seeder
{
    public function run(): void
    {
        $hashedPwd = Hash::make('test');

        $instructors = [
            [
                'account' => 'teacher1',
                'password' => $hashedPwd,
                'name' => '張偉',
                'email' => 'teacher1@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'account' => 'teacher2',
                'password' => $hashedPwd,
                'name' => '李明',
                'email' => 'teacher2@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'account' => 'teacher3',
                'password' => $hashedPwd,
                'name' => '王芳',
                'email' => 'teacher3@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'account' => 'teacher4',
                'password' => $hashedPwd,
                'name' => '陳靜',
                'email' => 'teacher4@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'account' => 'teacher5',
                'password' => $hashedPwd,
                'name' => '劉強',
                'email' => 'teacher5@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Instructor::insert($instructors);
    }
}
