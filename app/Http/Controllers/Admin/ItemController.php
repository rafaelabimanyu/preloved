<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Models\Drop;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Tag;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['drop', 'tags'])
            ->latest()
            ->paginate(20);

        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        $drops = Drop::orderBy('title')->get(['id', 'title']);
        $tags  = Tag::orderBy('name')->get();

        return view('admin.items.create', compact('drops', 'tags'));
    }

    public function store(StoreItemRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('items', 'public');
        }

        $item = Item::create($data);

        // Sync tags
        if ($request->filled('tags')) {
            $item->tags()->sync($request->tags);
        }

        // Additional gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $file) {
                $path = $file->store('items/gallery', 'public');
                ItemImage::create([
                    'item_id'    => $item->id,
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.items.index')->with('success', 'Item added to the archive.');
    }

    public function show(Item $item)
    {
        return redirect()->route('admin.items.edit', $item);
    }

    public function edit(Item $item)
    {
        $item->load(['images', 'tags', 'drop']);
        $drops = Drop::orderBy('title')->get(['id', 'title']);
        $tags  = Tag::orderBy('name')->get();

        return view('admin.items.edit', compact('item', 'drops', 'tags'));
    }

    public function update(StoreItemRequest $request, Item $item)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('items', 'public');
        }

        $item->update($data);
        $item->tags()->sync($request->tags ?? []);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $file) {
                $path = $file->store('items/gallery', 'public');
                ItemImage::create([
                    'item_id'    => $item->id,
                    'image_path' => $path,
                    'sort_order' => $item->images()->count() + $index,
                ]);
            }
        }

        return redirect()->route('admin.items.index')->with('success', 'Item updated.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('admin.items.index')->with('success', 'Item removed.');
    }
}
