<?php

use App\Models\Instructor;
use Database\Seeders\CourseSeeder;
use Database\Seeders\InstructorSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('取得所有講師資訊', function () {
    // Arrange
    $this->seed(InstructorSeeder::class);

    // Act
    $response = $this->getJson('/api/instructors');

    // Assert
    $response->assertOk()
        ->assertJsonCount(5, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'account',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
});

test('新增講師', function () {
    // Arrange
    $instructorData = [
        'account' => 'teacher123',
        'password' => 'password123',
        'name' => 'Ryan',
        'email' => 'teacher@example.com',
    ];

    // Act
    $response = $this->postJson('/api/instructors', $instructorData);

    // Assert
    $response->assertOk()
        ->assertJson([
            'data' => [
                'account' => $instructorData['account'],
                'name' => $instructorData['name'],
                'email' => $instructorData['email'],
            ],
        ]);

    $this->assertDatabaseHas('instructors', [
        'account' => $instructorData['account'],
        'name' => $instructorData['name'],
        'email' => $instructorData['email'],
    ]);
});

test('新增講師時沒有包含必要資訊', function () {
    // Arrange
    $invalid = [
        [
            'password' => 'password123',
            'name' => 'Ryan',
            'email' => 'teacher@example.com',
        ],
        [
            'account' => 'teacher123',
            'name' => 'Ryan',
            'email' => 'teacher@example.com',
        ],
        [
            'account' => 'teacher123',
            'password' => 'password123',
            'email' => 'teacher@example.com',
        ],
        [
            'account' => 'teacher123',
            'password' => 'password123',
            'name' => 'Ryan',
        ],
    ];
    $errors = ['account', 'password', 'name', 'email'];

    // Act
    foreach ($invalid as $key => $value) {
        $response = $this->postJson('/api/instructors', $value);

        // Assert
        $response->assertUnprocessable()
            ->assertJsonValidationErrors([$errors[$key]]);
    }
});

test('取得某位講師的開課資訊', function () {
    // Arrange
    $this->seed(InstructorSeeder::class);
    $this->seed(CourseSeeder::class);
    $instructor = Instructor::first();

    // Act
    $response = $this->getJson("/api/instructors/{$instructor->id}/courses");

    // Assert
    $response->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'start_time',
                    'end_time',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);

});

test('取得不存在的講師的開課資訊時返回404', function () {
    $response = $this->getJson('/api/instructors/999/courses');

    $response->assertNotFound();
});
