<?php

namespace App\Http\Controllers;

use App\Models\Drop;
use App\Models\Item;
use App\Models\Lookbook;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $activeDrop   = Drop::live()->with('items')->latest('released_at')->first();
        $recentItems  = Item::available()->with('tags')->latest()->take(6)->get();
        $latestLookbook = Lookbook::published()->first();

        return view('home.index', compact('activeDrop', 'recentItems', 'latestLookbook'));
    }
}
