<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Tag;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with(['tags', 'drop'])->orderByDesc('created_at');

        // Filter: category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filter: status (available / sold)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            // Default: show available + reserved (not sold) unless specifically requested
            $query->whereIn('status', ['available', 'reserved']);
        }

        // Filter: tag
        if ($request->filled('tag')) {
            $query->whereHas('tags', fn($q) => $q->where('slug', $request->tag));
        }

        // Filter: size
        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        $items      = $query->paginate(12)->withQueryString();
        $tags       = Tag::orderBy('name')->get();
        $categories = ['tops', 'bottoms', 'outerwear', 'accessories', 'shoes', 'bags'];

        return view('catalog.index', compact('items', 'tags', 'categories'));
    }
}
