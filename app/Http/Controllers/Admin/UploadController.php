<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120', // 5MB max
        ]);

        $path = $request->file('file')->store('uploads', 'public');

        return response()->json([
            'url'  => asset('storage/' . $path),
            'path' => $path,
        ]);
    }
}
