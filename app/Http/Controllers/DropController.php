<?php

namespace App\Http\Controllers;

use App\Models\Drop;

class DropController extends Controller
{
    public function index()
    {
        $drops = Drop::published()->withCount('items')->paginate(9);

        return view('drops.index', compact('drops'));
    }

    public function show(Drop $drop)
    {
        // Only show published drops to public
        abort_if(! in_array($drop->status, ['live', 'ended']), 404);

        $drop->load(['items.tags', 'items.images']);

        return view('drops.show', compact('drop'));
    }
}
