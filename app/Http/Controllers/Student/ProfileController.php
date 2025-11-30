<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStudentProfileRequest;
use App\Services\StudentService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function show()
    {
        $student = auth('student')->user();
        return view('student.profile.show', compact('student'));
    }

    public function edit()
    {
        $student = auth('student')->user();
        return view('student.profile.edit', compact('student'));
    }

    public function update(UpdateStudentProfileRequest $request)
    {
        $student = $this->studentService->updateStudent(
            auth('student')->id(),
            $request->validated()
        );

        return redirect()->route('student.profile.show')
            ->with('success', 'Profile updated successfully!');
    }
}
