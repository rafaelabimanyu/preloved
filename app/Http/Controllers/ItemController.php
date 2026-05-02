<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function show(Item $item)
    {
        $item->load(['images', 'tags', 'drop']);

        // Related items: same category or shared tags, excluding current, available only
        $related = Item::available()
            ->where('id', '!=', $item->id)
            ->where(function ($query) use ($item) {
                $query->where('category', $item->category)
                      ->orWhereHas('tags', fn($q) => $q->whereIn('tags.id', $item->tags->pluck('id')));
            })
            ->with('tags')
            ->take(4)
            ->get();

        return view('items.show', compact('item', 'related'));
    }
}
