<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    function index()
    {
        $settings = Setting::all();
        return view('pages.admin.setting.index', compact('settings'));
    }
    function edit(Request $request, $id)
    {
        $setting = Setting::find($id);
        Validator::make(
            $request->all(),
            [
                $setting->key => ['required']
            ]
        )->validate();
        $setting->value = (int) $request[$setting->key];
        // dd($request, $setting);
        $setting->save();
        return redirect(route('admin.setting.index'));
    }
}
