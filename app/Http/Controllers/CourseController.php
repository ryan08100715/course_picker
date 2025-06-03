<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Dedoc\Scramble\Attributes\BodyParameter;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * 取得所有課程資訊
     *
     * @response array{
     *   data: array<array{
     *      id: int,
     *      name: string,
     *      description: string|null,
     *      start_time: string,
     *      end_time: string,
     *      created_at: string,
     *      updated_at: string,
     *      instructor: array{
     *          id: int,
     *          name: string,
     *          email: string,
     *      }
     *   }>
     * }
     */
    public function index()
    {
        $courses = Course::with('instructor:id,name,email')->get();

        return $this->ok(CourseResource::collection($courses));
    }

    /**
     * 新增課程
     *
     * @response array{
     *   data: array{
     *     id: int,
     *     name: string,
     *     description: string|null,
     *     start_time: string,
     *     end_time: string,
     *     created_at: string,
     *     updated_at: string,
     *   }
     * }
     */
    #[BodyParameter('name', description: '課程名稱', example: 'Laravel 框架實務')]
    #[BodyParameter('description', description: '課程描述', example: null)]
    #[BodyParameter('start_time', description: '上課時間', type: 'string', example: '1300')]
    #[BodyParameter('end_time', description: '下課時間', type: 'string', example: '1400')]
    #[BodyParameter('instructor_id', description: '講師ID', example: 1)]
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:255'],
            'start_time' => ['required', 'date_format:Hi', 'before:end_time'],
            'end_time' => ['required', 'date_format:Hi', 'after:start_time'],
            'instructor_id' => ['required', 'integer', 'exists:\App\Models\Instructor,id'],
        ]);

        return $this->ok(new CourseResource(Course::create($data)));
    }

    /**
     * 更新課程資訊
     *
     * @response array{
     *   data: array{
     *     id: int,
     *     name: string,
     *     description: string|null,
     *     start_time: string,
     *     end_time: string,
     *     created_at: string,
     *     updated_at: string,
     *   }
     * }
     */
    #[BodyParameter('name', description: '課程名稱', example: 'Laravel 框架實務')]
    #[BodyParameter('description', description: '課程描述', example: null)]
    #[BodyParameter('start_time', description: '上課時間', type: 'string', example: '1300')]
    #[BodyParameter('end_time', description: '下課時間', type: 'string', example: '1400')]
    #[BodyParameter('instructor_id', description: '講師ID', example: 1)]
    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:255'],
            'start_time' => ['required', 'date_format:Hi', 'before:end_time'],
            'end_time' => ['required', 'date_format:Hi', 'after:start_time'],
            'instructor_id' => ['required', 'integer', 'exists:\App\Models\Instructor,id'],
        ]);

        $course->update($data);

        return $this->ok(new CourseResource($course));
    }

    /**
     * 刪除課程
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return $this->ok();
    }
}
