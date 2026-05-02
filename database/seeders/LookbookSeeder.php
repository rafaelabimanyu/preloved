<?php

namespace Database\Seeders;

use App\Models\Lookbook;
use App\Models\LookbookImage;
use Illuminate\Database\Seeder;

class LookbookSeeder extends Seeder
{
    public function run(): void
    {
        $lookbook = Lookbook::create([
            'title'        => 'Quiet Season — A Tokyo Autumn',
            'slug'         => 'quiet-season-tokyo-autumn',
            'description'  => 'Shot across three afternoons in Yanaka and Shimokitazawa. Quiet streets, golden light, pieces that feel like they belong to the city.',
            'cover_image'  => 'https://picsum.photos/id/1016/1200/900',
            'published_at' => now()->subWeeks(2),
        ]);

        $images = [
            [
                'image_path' => 'https://picsum.photos/id/1035/900/1200',
                'caption'    => 'Morning light through the covered arcade. The jacket was found in a basement shop near Shimokitazawa station.',
                'sort_order' => 0,
            ],
            [
                'image_path' => 'https://picsum.photos/id/1043/900/1200',
                'caption'    => 'The trousers against the temple stone. Everything is better when it has texture.',
                'sort_order' => 1,
            ],
            [
                'image_path' => 'https://picsum.photos/id/1062/900/1200',
                'caption'    => null,
                'sort_order' => 2,
            ],
        ];

        foreach ($images as $img) {
            LookbookImage::create([
                'lookbook_id' => $lookbook->id,
                'image_path'  => $img['image_path'],
                'caption'     => $img['caption'],
                'sort_order'  => $img['sort_order'],
            ]);
        }

        $this->command->info('  ✓  1 lookbook with 3 images created.');
    }
}
