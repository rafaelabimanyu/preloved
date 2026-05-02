<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Brand
            ['key' => 'brand.name',        'value' => 'preloved.g00ds',                'type' => 'text',    'group' => 'brand'],
            ['key' => 'brand.tagline',     'value' => 'Curated pieces. Real stories.', 'type' => 'text',    'group' => 'brand'],
            ['key' => 'brand.description', 'value' => 'Preloved fashion curated for those who believe clothes carry stories. Tokyo-inspired. Sustainably sourced.', 'type' => 'textarea', 'group' => 'brand'],
            ['key' => 'brand.logo',        'value' => null,                             'type' => 'image',   'group' => 'brand'],

            // Social
            ['key' => 'social.instagram',  'value' => 'https://instagram.com/preloved.g00ds', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social.whatsapp',   'value' => null,                                    'type' => 'url', 'group' => 'social'],
            ['key' => 'social.tiktok',     'value' => null,                                    'type' => 'url', 'group' => 'social'],

            // SEO
            ['key' => 'seo.title',          'value' => 'preloved.g00ds — Curated Vintage Fashion', 'type' => 'text',     'group' => 'seo'],
            ['key' => 'seo.description',    'value' => 'One-of-a-kind preloved fashion pieces. Tokyo streetwear, Y2K, Harajuku, vintage and minimalist curated drops.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'seo.og_image',       'value' => null,                                       'type' => 'image',    'group' => 'seo'],

            // Contact
            ['key' => 'contact.email',      'value' => 'hello@preloved.goods', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact.location',   'value' => 'Jakarta, Indonesia',   'type' => 'text', 'group' => 'contact'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
