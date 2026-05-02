<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $groups = [
            'brand'   => Setting::where('group', 'brand')->get(),
            'social'  => Setting::where('group', 'social')->get(),
            'seo'     => Setting::where('group', 'seo')->get(),
            'contact' => Setting::where('group', 'contact')->get(),
        ];

        return view('admin.settings.index', compact('groups'));
    }

    public function update(Request $request)
    {
        $settings = $request->input('settings', []);

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        // Handle image uploads for settings
        foreach ($request->allFiles() as $key => $file) {
            $cleanKey = str_replace('__', '.', $key); // convert form key back to dot notation
            $path = $file->store('settings', 'public');
            Setting::set($cleanKey, $path);
        }

        return back()->with('success', 'Settings saved.');
    }
}
