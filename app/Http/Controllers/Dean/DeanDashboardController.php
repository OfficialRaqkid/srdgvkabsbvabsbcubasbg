<?php

namespace App\Http\Controllers\Dean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ Add this

class DeanDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dean.dashboard', [
            'user' => Auth::user() 
        ]);
    }
}
