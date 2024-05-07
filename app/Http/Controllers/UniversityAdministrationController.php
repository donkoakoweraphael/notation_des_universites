<?php

namespace App\Http\Controllers;

use App\Models\InformationSection;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniversityAdministrationController extends Controller
{
    function index()
    {
        $universities = University::all();
        return view('pages.admin.university.index', compact('universities'));
    }

    function create()
    {
        return view('pages.admin.university.create');
    }

    function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255', 'unique:' . University::class],
                'description' => ['required', 'string']
            ]
        );
        if (!$request->image_path) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'image_path',
                    'Le champ image est requis'
                );
            });
        }

        // dd($request->file('image_path'));

        try {

            $path = $request->file('image_path')->store('images', ['disk' => 'public']);
        } catch (\Throwable $th) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'image_path',
                    'Le fichier n\'est pas valide'
                );
            });
        }

        $validator->validate();

        $university = University::create([
            'name' => $request->name,
            'image_path' => $path,
        ]);

        InformationSection::create([
            'title' => 'Description',
            'content' => $request->description,
            'university_id' => $university->id
        ]);
        return redirect(route('admin.university.edit', $university->id));
    }

    function edit($id)
    {
        $university = University::find($id);
        return view('pages.admin.university.edit', compact('university'));
    }

    function update(Request $request, $id)
    {
        $university = University::find($id);

        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
            ]
        );

        if ($request->name != $university->name) {
            $validator->addRules(['name' => ['unique:' . University::class]]);
        }

        if ($request->email) {
            $validator->addRules(['email' => ['email']]);
        }

        // if ($request->phone_number) {
        //     $validator->addRules(['phone_number' => ['tel']]);
        // }

        if ($request->web_site) {
            $validator->addRules(['web_site' => ['url']]);
        }

        if ($request->image_path) {
            try {
                $path = $request->file('image_path')->store('images', ['disk' => 'public']);
            } catch (\Throwable $th) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'image_path',
                        'Le fichier n\'est pas valide'
                    );
                });
            }
        }

        $validator->validate();

        $university->name = $request->name;
        $university->email = $request->email;
        $university->web_site = $request->web_site;
        $university->phone_number = $request->phone_number;
        if ($request->image_path) {
            $university->image_path = $path;
        }

        $university->informationSections()
            ->where('title', '=', 'Description')
            ->update(['content' => $request->description]);

        $university->save();

        return redirect(route('admin.university.edit', $id));
    }

    function destroy(Request $request, $id)
    {
    }
}
