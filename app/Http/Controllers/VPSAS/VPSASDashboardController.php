<?php

namespace App\Http\Controllers\VPSAS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VPSASDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.vp_sas.dashboard', [
            'user' => Auth::user(),
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

