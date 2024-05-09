<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CriterionController extends Controller
{

    function index()
    {
        $criteria = Criterion::all();
        return view('pages.admin.criterion.index', compact('criteria'));
    }

    function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'designation' => ['required', 'string', 'max:255', 'unique:'.Criterion::class],
            ]
        )->validate();

        Criterion::create([
            'designation' => $request->designation
        ]);

        return redirect(route('admin.criterion.index'));
    }

    function edit($id)
    {
        $criterion = Criterion::where('id', $id)->first();
        $criteria = Criterion::all();
        return view('pages.admin.criterion.index', compact(['criteria', 'criterion']));
    }

    function update(Request $request, $id)
    {
        Validator::make(
            $request->all(),
            [
                'designation' => ['required', 'string', 'max:255'],
            ]
        )->validate();

        Criterion::where('id', $id)->update([
            'designation' => $request->designation
        ]);

        return redirect(route('admin.criterion.index'));
    }

    function destroy(Request $request, $id)
    {
        Criterion::where('id', $id)->delete();

        return redirect(route('admin.criterion.index'));
    }
}
