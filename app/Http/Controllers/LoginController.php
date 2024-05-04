<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('pages.login');
    }

    public function authenticate(Request $request)//: RedirectResponse
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => ['required', 'email'],
                'password' => ['required']
            ]
        );
        $credentials = $validator->validate();

        $existingUser = User::where('email', '=', $request->email)
            ->where('is_deleted', '=', 0)
            ->first();

        if ($existingUser) {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                if ($existingUser->is_admin) {
                    return redirect()->intended(route('admin.dashboard'));
                }
                return redirect()->intended(route('user.home'));
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        $existingUser = User::where('email', '=', $request->email)
            ->where('is_deleted', '<>', 0)
            ->orderByDesc('is_deleted')
            ->first();

        if ($existingUser) {
            $GLOBALS['deletion_reasons'] = $existingUser->deletion_reasons;
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'top_info',
                    'compte supprimé'
                );
                $validator->errors()->add(
                    'deletion_reasons',
                    $GLOBALS['deletion_reasons']
                );
            });
            $validator->validate();
        } else {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'top_info',
                    'compte n\'existe pas'
                );
            });
            $validator->validate();
        }
    }
}
