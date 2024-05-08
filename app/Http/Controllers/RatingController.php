<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    function store(Request $request, $univ_id)
    {
        $criteria = Criterion::all();
        foreach ($criteria as $criterion) {
            if ($request['criterion' . $criterion->id]) {
                Rating::create([
                    'score' => $request['criterion'. $criterion->id],
                    'user_id' => Auth::user()->id,
                    'university_id' => $univ_id,
                    'criterion_id' => $criterion->id
                ]);
            }
        }
        return redirect(route('user.university.read', [$univ_id]));
    }
}
