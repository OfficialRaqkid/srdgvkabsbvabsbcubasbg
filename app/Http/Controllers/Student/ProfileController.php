<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('dashboard.student.profile');
    }

    public function update(Request $request)
    {
        // Profile update logic here
    }

    public function destroy()
    {
        // Profile deletion or logout logic
    }
}
