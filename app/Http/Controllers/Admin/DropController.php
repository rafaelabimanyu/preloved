<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDropRequest;
use App\Models\Drop;
use Illuminate\Support\Str;

class DropController extends Controller
{
    public function index()
    {
        $drops = Drop::withCount('items')->latest()->paginate(15);

        return view('admin.drops.index', compact('drops'));
    }

    public function create()
    {
        return view('admin.drops.create');
    }

    public function store(StoreDropRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('drops', 'public');
        }

        Drop::create($data);

        return redirect()->route('admin.drops.index')->with('success', 'Drop created successfully.');
    }

    public function show(Drop $drop)
    {
        return redirect()->route('admin.drops.edit', $drop);
    }

    public function edit(Drop $drop)
    {
        $drop->load('items');

        return view('admin.drops.edit', compact('drop'));
    }

    public function update(StoreDropRequest $request, Drop $drop)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('drops', 'public');
        }

        $drop->update($data);

        return redirect()->route('admin.drops.index')->with('success', 'Drop updated.');
    }

    public function destroy(Drop $drop)
    {
        $drop->delete();

        return redirect()->route('admin.drops.index')->with('success', 'Drop deleted.');
    }
}
