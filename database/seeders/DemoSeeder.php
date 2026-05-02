<?php

namespace Database\Seeders;

use App\Models\Drop;
use App\Models\Item;
use App\Models\Tag;
use Illuminate\Database\Seeder;


class DemoSeeder extends Seeder
{
    // Picsum photo IDs — consistently muted/cinematic tones
    private array $photos = [
        'https://picsum.photos/id/1035/800/1067', // jacket
        'https://picsum.photos/id/1036/800/1067', // shirt
        'https://picsum.photos/id/1011/800/1067', // trousers
        'https://picsum.photos/id/1005/800/1067', // accessory
        'https://picsum.photos/id/1074/800/1067', // bag
        'https://picsum.photos/id/883/800/1067',  // shoes
        'https://picsum.photos/id/974/800/1067',  // outerwear
        'https://picsum.photos/id/1062/800/1067', // top
        'https://picsum.photos/id/1080/800/1067', // bottom
        'https://picsum.photos/id/1039/800/1067', // extra
    ];

    public function run(): void
    {
        // Load tags already created by TagSeeder
        $tags = \App\Models\Tag::whereIn('slug', [
            'y2k', 'vintage', 'harajuku', 'minimalist', 'streetwear', 'grunge',
        ])->get()->keyBy('slug');

        // ── Drops ─────────────────────────────────────────────────────────
        $liveDrop = Drop::create([
            'title'       => 'Tokyo Rain Vol.1',
            'slug'        => 'tokyo-rain-vol-1',
            'description' => 'Collected from the backstreets of Shimokitazawa. Pieces that carry the quiet weight of rainy seasons and late trains.',
            'cover_image' => 'https://picsum.photos/id/1016/1600/900',
            'status'      => 'live',
            'released_at' => now()->subDays(3),
        ]);

        $endedDrop = Drop::create([
            'title'       => 'Autumn Archive 001',
            'slug'        => 'autumn-archive-001',
            'description' => 'A closed chapter — 8 pieces from a single autumn wardrobe. All found their homes.',
            'cover_image' => 'https://picsum.photos/id/1043/1600/900',
            'status'      => 'ended',
            'released_at' => now()->subMonths(2),
            'ended_at'    => now()->subMonth(),
        ]);

        // ── Items — Live Drop (6 items) ───────────────────────────────────
        $liveItems = [
            [
                'title'     => 'Shimokita Denim Jacket',
                'slug'      => 'shimokita-denim-jacket',
                'category'  => 'outerwear',
                'size'      => 'M',
                'condition' => 'excellent',
                'price'     => 380000,
                'status'    => 'available',
                'tags'      => ['vintage', 'streetwear'],
                'photo'     => 0,
                'description' => 'Double-washed indigo. Faded in all the right places — not by treatment, but by time. The kind of jacket that does not announce itself. It simply arrives and changes the silhouette.',
                'measurements' => ['chest' => 54, 'shoulder' => 46, 'length' => 68],
            ],
            [
                'title'     => 'Y2K Nylon Windbreaker',
                'slug'      => 'y2k-nylon-windbreaker',
                'category'  => 'outerwear',
                'size'      => 'L',
                'condition' => 'good',
                'price'     => 290000,
                'status'    => 'reserved',
                'tags'      => ['y2k', 'streetwear'],
                'photo'     => 1,
                'description' => 'Navy nylon with a neon trim that remembers a specific kind of optimism. It belonged to someone who believed the future was bold. That era is gone. This jacket remains.',
                'measurements' => ['chest' => 58, 'shoulder' => 48, 'length' => 72],
            ],
            [
                'title'     => 'Harajuku Graphic Tee',
                'slug'      => 'harajuku-graphic-tee',
                'category'  => 'tops',
                'size'      => 'S',
                'condition' => 'good',
                'price'     => 120000,
                'status'    => 'available',
                'tags'      => ['harajuku', 'y2k'],
                'photo'     => 7,
                'description' => 'The print is faded in the way only time can manage — not distressed, not treated. Simply worn, the way clothes are meant to be. A decade of presence, compressed into cotton.',
                'measurements' => ['chest' => 48, 'shoulder' => 40, 'length' => 64],
            ],
            [
                'title'     => 'Pleated Wool Trousers',
                'slug'      => 'pleated-wool-trousers',
                'category'  => 'bottoms',
                'size'      => 'M',
                'condition' => 'excellent',
                'price'     => 260000,
                'status'    => 'available',
                'tags'      => ['minimalist', 'vintage'],
                'photo'     => 2,
                'description' => 'High-waist pleated trousers in charcoal wool. A cut that carries authority without declaring it. The silhouette is decade-less — it belongs to no particular era, and therefore to all of them.',
                'measurements' => ['waist' => 74, 'hip' => 96, 'length' => 100],
            ],
            [
                'title'     => 'Linen Utility Vest',
                'slug'      => 'linen-utility-vest',
                'category'  => 'tops',
                'size'      => 'M',
                'condition' => 'mint',
                'price'     => 175000,
                'status'    => 'available',
                'tags'      => ['minimalist', 'streetwear'],
                'photo'     => 7,
                'description' => 'Stone-washed linen in a cut that suggests purpose without performing it. Multiple pockets. Zero excess. Barely worn — as if it was waiting for the right person to take it somewhere.',
                'measurements' => ['chest' => 52, 'shoulder' => 44, 'length' => 58],
            ],
            [
                'title'     => 'Canvas Tote Bag',
                'slug'      => 'canvas-tote-bag',
                'category'  => 'bags',
                'size'      => null,
                'condition' => 'good',
                'price'     => 95000,
                'status'    => 'available',
                'tags'      => ['minimalist'],
                'photo'     => 4,
                'description' => 'Natural canvas. Reinforced handles. The kind of bag that is present without demanding attention — which is the most difficult thing to achieve in fashion.',
                'measurements' => null,
            ],
        ];

        foreach ($liveItems as $data) {
            $item = Item::create([
                'drop_id'      => $liveDrop->id,
                'title'        => $data['title'],
                'slug'         => $data['slug'],
                'description'  => $data['description'],
                'category'     => $data['category'],
                'size'         => $data['size'],
                'condition'    => $data['condition'],
                'price'        => $data['price'],
                'status'       => $data['status'],
                'cover_image'  => $this->photos[$data['photo']],
                'measurements' => $data['measurements'],
            ]);

            $tagIds = $tags->whereIn('slug', $data['tags'])->pluck('id');
            $item->tags()->sync($tagIds);
        }

        // ── Items — Ended Drop (4 items, mostly sold) ─────────────────────
        $endedItems = [
            [
                'title'     => 'Showa-Era Blazer',
                'slug'      => 'showa-era-blazer',
                'category'  => 'outerwear',
                'size'      => 'S',
                'condition' => 'good',
                'price'     => 320000,
                'status'    => 'sold',
                'tags'      => ['vintage'],
                'photo'     => 6,
            ],
            [
                'title'     => 'Grunge Flannel Shirt',
                'slug'      => 'grunge-flannel-shirt',
                'category'  => 'tops',
                'size'      => 'L',
                'condition' => 'fair',
                'price'     => 140000,
                'status'    => 'sold',
                'tags'      => ['grunge', 'vintage'],
                'photo'     => 1,
            ],
            [
                'title'     => 'Corduroy Bucket Hat',
                'slug'      => 'corduroy-bucket-hat',
                'category'  => 'accessories',
                'size'      => 'Free',
                'condition' => 'excellent',
                'price'     => 85000,
                'status'    => 'sold',
                'tags'      => ['streetwear', 'harajuku'],
                'photo'     => 3,
            ],
            [
                'title'     => 'Leather Belt — Tan',
                'slug'      => 'leather-belt-tan',
                'category'  => 'accessories',
                'size'      => '80cm',
                'condition' => 'excellent',
                'price'     => 75000,
                'status'    => 'sold',
                'tags'      => ['minimalist', 'vintage'],
                'photo'     => 5,
            ],
        ];

        foreach ($endedItems as $data) {
            $item = Item::create([
                'drop_id'     => $endedDrop->id,
                'title'       => $data['title'],
                'slug'        => $data['slug'],
                'category'    => $data['category'],
                'size'        => $data['size'],
                'condition'   => $data['condition'],
                'price'       => $data['price'],
                'status'      => $data['status'],
                'cover_image' => $this->photos[$data['photo']],
            ]);

            $tagIds = $tags->whereIn('slug', $data['tags'])->pluck('id');
            $item->tags()->sync($tagIds);
        }

        $this->command->info('  ✓  2 drops, 10 items, 6 tags created.');
    }
}
