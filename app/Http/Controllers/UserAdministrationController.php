<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAdministrationController extends Controller
{
    function index()
    {
        $users = User::where('is_deleted', '=', 0)->get();
        return view('pages.admin.user.index', compact('users'));
    }
}
