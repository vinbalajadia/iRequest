<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentLoginRequest;
use App\Http\Requests\StudentRegistrationRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('student.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'student_id';
        $credentials = [$loginType => $request->login, 'password' => $request->password];

        if (Auth::guard('student')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('student.dashboard'));
        }

        return back()->withErrors(['login' => 'Invalid credentials'])->onlyInput('login');
    }

    public function showRegistrationForm()
    {
        return view('student.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:6|confirmed',
            'course' => 'required|string',
            'year_level' => 'required|integer',
            'contact_number' => 'nullable|string',
        ]);

        $student = Student::create([
            'student_id' => $request->student_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'course' => $request->course,
            'year_level' => $request->year_level,
            'contact_number' => $request->contact_number,
        ]);

        Auth::guard('student')->login($student);

        return redirect()->route('student.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('student.login');
    }
}
