<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    function edit()
    {
        $user = Auth::user();
        return view('pages.user.profile', compact('user'));
    }

    function updateImage(Request $request)
    {
        if ($request->image_path) {
            $path = $request->file('image_path')->store('images', ['disk' => 'public']);
            $request->user()->image_path = $path;
            $request->user()->save();
        }
        return redirect(route('user.profile'));
    }

    function updatePassword(Request $request)
    {
        // $validator = Validator::make($request->all(),[]);
        // $validator->setRules([
        //     'current_password' => ['required'],
        //     // 'password' => ['required', 'confirmed', Password::min(8)]
        // ]);
        // dd($request->user()->password, Hash::make($request->current_password));
        // $validator->validate();
        // if (Hash::make($request->current_password) != $request->user()->password) {
        //     $validator->after(function ($validator) {
        //         $validator->errors()->add(
        //             'current_password',
        //             'Mot de passe incorrect'
        //         );
        //     });
        // }
        // $validator->validate();
        // $validator->setRules([
        //     'password' => ['required', 'confirmed', Password::min(8)]
        // ]);
        // $validator->validate();
        return redirect(route('user.profile'));
    }

    function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255']
            ]
        );
        $validator->validate();

        $existingUser = User::where('email', '=', $request->email)
            ->where('is_deleted', '=', 0)
            ->first();

        if ($existingUser && $existingUser->id == $request->user()->id) {
            $existingUser->last_name = $request->last_name;
            $existingUser->first_name = $request->first_name;
            $existingUser->email = $request->email;
            $existingUser->sex = $request->sex;
            $existingUser->birth_date = $request->birth_date;
            $existingUser->save();
        } else {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'email',
                    'L\'addresse email saisie est déjà utilisé'
                );
            });
            $validator->validate();
        }
        return redirect(route('user.profile'));
    }
}
