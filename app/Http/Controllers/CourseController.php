<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('instructor:id,name,email')->get();

        return $this->ok(CourseResource::collection($courses));
    }

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

    public function destroy(Course $course)
    {
        $course->delete();

        return $this->ok();
    }
}
