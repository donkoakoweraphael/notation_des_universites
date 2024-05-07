<?php

namespace App\Http\Controllers;

use App\Models\InformationSection;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformationSectionController extends Controller
{
    function store(Request $request, $univ_id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string']
            ]
        );

        $info = InformationSection::where('university_id', '=', $univ_id)->where('title', '=', $request->title)->first();
        if ($info) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'title',
                    'Une section existe déjà avec ce titre'
                );
            });
        }

        $path = null;
        if ($request->section_image_path) {
            try {
                $path = $request->file('section_image_path')->store('images', ['disk' => 'public']);
            } catch (\Throwable $th) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'section_image_path',
                        'Le fichier n\'est pas valide'
                    );
                });
            }
        }

        $validator->validate();

        InformationSection::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $path,
            'university_id' => $univ_id
        ]);
        return redirect(route('admin.university.edit', $univ_id));
    }

    function update(Request $request, $id)
    {
        $GLOBALS['id'] = $id;
        $validator = Validator::make(
            $request->all(),
            [
                'title' . $id => ['required', 'string', 'max:255'],
                'content' . $id => ['required', 'string']
            ]
        );
        $info = InformationSection::find($id);
        $infoReq = InformationSection::where('university_id', '=', $info->university()->first()->id)->where('title', '=', $request['title' . $id])->first();
        if ($infoReq && $infoReq->title != $info->title) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'title' . $GLOBALS['id'],
                    'Une section existe déjà avec le titre saisit'
                );
            });
        }

        $path = null;
        if ($request['section_image_path' . $id]) {
            try {
                $path = $request->file('section_image_path' . $id)->store('images', ['disk' => 'public']);
            } catch (\Throwable $th) {
                $validator->after(function ($validator) {
                    $validator->errors()->add(
                        'section_image_path' . $GLOBALS['id'],
                        'Le fichier n\'est pas valide'
                    );
                });
            }
        }

        $validator->validate();

        $info->title = $request['title'.$id];
        $info->content = $request['content'.$id];
        if ($path) {
            $info->image_path = $path;
        }
        $info->save();

        return redirect(route('admin.university.edit', $info->university()->first()->id));
    }

    function destroy(Request $request, $id)
    {

    }
}
