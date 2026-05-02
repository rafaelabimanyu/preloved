<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLookbookRequest;
use App\Models\Item;
use App\Models\Lookbook;
use App\Models\LookbookImage;
use Illuminate\Support\Str;

class LookbookController extends Controller
{
    public function index()
    {
        $lookbooks = Lookbook::withCount('images')->latest()->paginate(15);

        return view('admin.lookbooks.index', compact('lookbooks'));
    }

    public function create()
    {
        $items = Item::orderBy('title')->get(['id', 'title', 'slug']);

        return view('admin.lookbooks.create', compact('items'));
    }

    public function store(StoreLookbookRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('lookbooks', 'public');
        }

        $lookbook = Lookbook::create($data);

        $this->syncImages($request, $lookbook);

        return redirect()->route('admin.lookbooks.index')->with('success', 'Lookbook published.');
    }

    public function show(Lookbook $lookbook)
    {
        return redirect()->route('admin.lookbooks.edit', $lookbook);
    }

    public function edit(Lookbook $lookbook)
    {
        $lookbook->load(['images.linkedItem']);
        $items = Item::orderBy('title')->get(['id', 'title', 'slug']);

        return view('admin.lookbooks.edit', compact('lookbook', 'items'));
    }

    public function update(StoreLookbookRequest $request, Lookbook $lookbook)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('lookbooks', 'public');
        }

        $lookbook->update($data);
        $this->syncImages($request, $lookbook);

        return redirect()->route('admin.lookbooks.index')->with('success', 'Lookbook updated.');
    }

    public function destroy(Lookbook $lookbook)
    {
        $lookbook->delete();

        return redirect()->route('admin.lookbooks.index')->with('success', 'Lookbook deleted.');
    }

    private function syncImages($request, Lookbook $lookbook): void
    {
        if ($request->hasFile('images')) {
            $offset = $lookbook->images()->count();
            foreach ($request->file('images') as $index => $file) {
                $path    = $file->store('lookbooks/images', 'public');
                $caption = $request->input("captions.{$index}");
                $linkedItemId = $request->input("linked_items.{$index}");

                LookbookImage::create([
                    'lookbook_id'    => $lookbook->id,
                    'image_path'     => $path,
                    'caption'        => $caption,
                    'linked_item_id' => $linkedItemId ?: null,
                    'sort_order'     => $offset + $index,
                ]);
            }
        }
    }
}
