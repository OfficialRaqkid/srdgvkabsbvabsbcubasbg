<?php

namespace App\Http\Controllers\LibraryInCharge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryInChargeDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.library_in_charge.dashboard', [
            'user' => Auth::user()
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}

