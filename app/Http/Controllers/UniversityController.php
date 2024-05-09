<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Criterion;
use App\Models\Rating;
use App\Models\Setting;
use App\Models\University;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniversityController extends Controller
{
    function index()
    {
        $criteria = Criterion::all();
        $universities = University::all();

        $page_number = 1;
        $universitySearch = '';
        $criteriaIds = [];
        if (isset($_GET['c'])) {
            $criteriaIds = $_GET['c'];
        } else {
            // foreach ($criteria as $criterion) {
            //     $criteriaIds[] = $criterion->id;
            // }
        }
        $criteriaIds_str = implode(', ', $criteriaIds);

        $number_of_digits_after_decimal_point = Setting::where('key', 'number_of_digits_after_decimal_point')->first()->value;
        $max_note_to_display = Setting::where('key', 'max_note_to_display')->first()->value;
        $number_of_university_per_page = Setting::where('key', 'number_of_university_per_page')->first()->value;

        $number_of_university_per_page = 100;

        $sqlRequest = "SELECT u.*, COUNT(r.id) AS nombre_avis, COALESCE(SUM(r.score), 0) AS total_score, ROUND((COALESCE(AVG(r.score),0)/5)*$max_note_to_display, $number_of_digits_after_decimal_point ) AS mean_score, $max_note_to_display AS max_note
        FROM universities u LEFT JOIN ( SELECT * FROM ratings r ";
        if (isset($_GET['c'])) {
            $sqlRequest = $sqlRequest . "WHERE r.criterion_id IN( $criteriaIds_str )";
        }
        $sqlRequest = $sqlRequest . " ) AS r
            ON r.university_id = u.id
        WHERE u.name LIKE '%$universitySearch%' 
        GROUP BY u.id
        ORDER BY mean_score DESC, nombre_avis DESC
        LIMIT $number_of_university_per_page OFFSET " . ($page_number - 1) * $number_of_university_per_page;

        $classifiedUniversities = DB::select($sqlRequest);

        // dd($sqlRequest, $classifiedUniversities);
        return view('pages.user.home', compact('criteria', 'classifiedUniversities'));
    }

    function read($id)
    {
        $university = University::find($id);

        $alreadyRated = Rating::where('user_id', Auth::user()->id)
            ->where('university_id', '=', $id)
            ->get();

        $alreadyRatedCriteriaIds = [];
        foreach ($alreadyRated as $criterion) {
            $alreadyRatedCriteriaIds[] = $criterion->criterion_id;
        }

        $criteria = Criterion::whereNotIn('id', $alreadyRatedCriteriaIds)->get();

        $comments = Comment::where('university_id', $university->id)->orderByDesc('created_at')->get();

        return view('pages.user.university.read', compact(['university', 'criteria', 'comments']));
    }
}
