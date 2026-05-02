<?php

namespace App\Http\Controllers;

use App\Models\Lookbook;

class LookbookController extends Controller
{
    public function index()
    {
        $lookbooks = Lookbook::published()->paginate(6);

        return view('lookbook.index', compact('lookbooks'));
    }

    public function show(Lookbook $lookbook)
    {
        abort_if(! $lookbook->published_at || $lookbook->published_at->isFuture(), 404);

        $lookbook->load(['images.linkedItem.tags']);

        return view('lookbook.show', compact('lookbook'));
    }
}
