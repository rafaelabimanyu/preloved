<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Y2K',           'slug' => 'y2k',           'color' => '#C4A882'],
            ['name' => 'Harajuku',      'slug' => 'harajuku',      'color' => '#8B9E7A'],
            ['name' => 'Vintage',       'slug' => 'vintage',       'color' => '#A08C72'],
            ['name' => 'Tokyo Street',  'slug' => 'tokyo-street',  'color' => '#7A8899'],
            ['name' => 'Minimalist',    'slug' => 'minimalist',    'color' => '#9E9E8E'],
            ['name' => 'Grunge',        'slug' => 'grunge',        'color' => '#7D7165'],
            ['name' => 'Workwear',      'slug' => 'workwear',      'color' => '#8A8070'],
            ['name' => 'Soft Boy',      'slug' => 'soft-boy',      'color' => '#B8A8C0'],
            ['name' => 'Archive',       'slug' => 'archive',       'color' => '#6E7B6E'],
            ['name' => 'Streetwear',    'slug' => 'streetwear',    'color' => '#5C6070'],
        ];

        foreach ($tags as $tag) {
            Tag::updateOrCreate(['slug' => $tag['slug']], $tag);
        }
    }
}
