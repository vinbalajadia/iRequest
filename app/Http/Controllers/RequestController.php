<?php

namespace App\Http\Controllers;

use App\Models\Request as DocumentRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;


class RequestController extends Controller
{

    public function myRequest()
    {
        return view('student.my-request', [
            'requests' => Auth::user()->requests()->latest()->get(),
        ]);
    }
    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function create()
    {
        return view('student.request-create');
    }

    public function store(HttpRequest $request)
    {
        $request->validate([
            'document_type' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        DocumentRequest::create([
            'user_id' => Auth::id(), 
            'document_type' => $request->document_type,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('dashboard')->with('success', 'Request submitted successfully!');
    }
}
