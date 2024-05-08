<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    function store(Request $request, $univ_id)
    {
        if ($request->message) {
            Validator::make(
                $request->all(),
                [
                    'message' => ['string', 'max:255'],
                ]
            )->validate();
        }
        Comment::create([
            'message' => $request->message,
            'university_id' => $univ_id,
            'user_id' => Auth::user()->id
        ]);
        return redirect(route('user.university.read', $univ_id));
    }
}
