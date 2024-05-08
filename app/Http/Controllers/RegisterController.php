<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('pages.register');
    }

    public function store(Request $request)//: Response
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'password' => ['required', 'confirmed', Password::min(8)]
            ]
        );
        $validator->validate();

        $existingUser = User::where('email', '=', $request->email)
            ->where('is_deleted', '=', 0)
            ->first();

        if ($existingUser) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'top_info',
                    'compte existe deja'
                );
            });
            $validator->validate();
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('user.home'));
    }
}
