<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard() {
        $statistics = [
            'users_number' => User::where('is_deleted', '=', 0)->count(),
            'deleted_users_number' => User::where('is_deleted', '!=', 0)->count(),
            'universities_number' => University::count(),
        ];
        return view('pages.admin.dashboard', compact('statistics'));
    }
}
