<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('preloved:check', function () {
    $views = [
        ['home.index',    ['activeDrop' => null, 'recentItems' => collect(), 'latestLookbook' => null]],
        ['pages.about',   []],
        ['pages.care',    []],
        ['pages.contact', ['items' => collect()]],
        ['drops.index',   ['drops' => \App\Models\Drop::paginate(9)]],
        ['lookbook.index',['lookbooks' => \App\Models\Lookbook::paginate(6)]],
        ['catalog.index', ['items' => \App\Models\Item::paginate(12), 'tags' => \App\Models\Tag::all(), 'categories' => ['tops','bottoms','outerwear','accessories','shoes','bags']]],
        ['admin.dashboard', [
            'stats'            => ['available_items'=>0,'sold_items'=>0,'total_drops'=>0,'live_drops'=>0,'total_lookbooks'=>0,'unread_inquiries'=>0,'total_items'=>0],
            'recentInquiries'  => collect(),
            'recentItems'      => collect(),
            'liveDrop'         => null,
        ]],
        ['admin.drops.index',    ['drops' => \App\Models\Drop::paginate(15)]],
        ['admin.drops.create',   []],
        ['admin.items.index',    ['items' => \App\Models\Item::paginate(20)]],
        ['admin.lookbooks.index',['lookbooks' => \App\Models\Lookbook::paginate(15)]],
        ['admin.inquiries.index',['inquiries' => \App\Models\Inquiry::paginate(20)]],
        ['admin.settings.index', ['groups' => ['brand'=>collect(),'social'=>collect(),'seo'=>collect(),'contact'=>collect()]]],
    ];

    foreach ($views as [$view, $data]) {
        try {
            view($view, $data)->render();
            $this->info("  ✓  {$view}");
        } catch (\Throwable $e) {
            $this->error("  ✗  {$view}: " . $e->getMessage());
        }
    }

    $this->line('');
    $this->info('Check complete.');
})->describe('Check all preloved.g00ds views render without errors');
