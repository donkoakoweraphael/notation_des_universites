<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    function read($id)
    {
        $university = University::where('');
        $university = University::find($id);
        return view('pages.user.university.read', compact('university'));
    }
}
