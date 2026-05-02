<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drop;
use App\Models\Inquiry;
use App\Models\Item;
use App\Models\Lookbook;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_items'      => Item::count(),
            'available_items'  => Item::available()->count(),
            'sold_items'       => Item::where('status', 'sold')->count(),
            'total_drops'      => Drop::count(),
            'live_drops'       => Drop::live()->count(),
            'total_lookbooks'  => Lookbook::count(),
            'unread_inquiries' => Inquiry::unread()->count(),
        ];

        $recentInquiries = Inquiry::with('item')
            ->latest()
            ->take(5)
            ->get();

        $recentItems = Item::with('drop')
            ->latest()
            ->take(6)
            ->get();

        $liveDrop = Drop::live()->with('items')->latest('released_at')->first();

        return view('admin.dashboard', compact('stats', 'recentInquiries', 'recentItems', 'liveDrop'));
    }
}
