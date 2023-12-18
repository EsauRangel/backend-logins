<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeacherTasks;
use Illuminate\Support\Facades\Storage;

class TeachersTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:teachers");
    }
    public function show()
    {
        $tasks = TeacherTasks::all();

        return response()->json(["success" => $tasks]);
    }

    public function store()
    {
        request()->validate([
            'image_url' => 'nullable|file',
            'description' => 'required|string',
            'student_id' => 'required|numeric|exists:students,id',
        ]);

        $date = now()->format("YmdHis");
        if (request()->image_url) {
            request()->image_url = Storage::disk("s3-disk")->putFileAs("public", request()->file('image_url'), "mi-imagen$date.png");
        }

        $task = TeacherTasks::create([
            'image_url' => request()->image_url,
            'description' => request()->description,
            'student_id' => request()->student_id,
        ]);

        $task->load("student");

        return response()->json(["success" => $task]);
    }
}
