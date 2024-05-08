<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use App\Models\Rating;
use App\Models\University;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniversityController extends Controller
{
    function read($id)
    {
        $university = University::find($id);

        // $alreadyRated = DB::table('ratings')
        $alreadyRated = Rating::where('user_id', Auth::user()->id)
            ->where('university_id', '=', $id)
            ->get();

        $alreadyRatedCriteriaIds = [];
        foreach ($alreadyRated as $criterion) {
            $alreadyRatedCriteriaIds[] = $criterion->criterion_id;
        }

        $criteria = Criterion::whereNotIn('id', $alreadyRatedCriteriaIds)->get();

        return view('pages.user.university.read', compact(['university', 'criteria']));
    }
}
