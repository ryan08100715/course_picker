<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Http\Resources\InstructorResource;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    /**
     * 取得所有講師資訊
     */
    public function index()
    {
        return $this->ok(InstructorResource::collection(Instructor::all()));
    }

    /**
     * 新增講師
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'account' => ['required', 'string', 'max:100', 'unique:App\Models\Instructor,account'],
            'password' => ['required', 'string', 'min:6', 'max:30'],
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:50'],
        ]);

        $data['password'] = Hash::make($data['password']);

        return $this->ok(new InstructorResource(Instructor::create($data)));
    }

    /**
     * 取得某位講師的開課資訊
     *
     * @response array{
     *    data: array<array{
     *       id: int,
     *       name: string,
     *       description: string|null,
     *       start_time: string,
     *       end_time: string,
     *       created_at: string,
     *       updated_at: string,
     *     }>
     *  }
     */
    public function courseIndex(Instructor $instructor)
    {
        return $this->ok(CourseResource::collection($instructor->courses));
    }
}
