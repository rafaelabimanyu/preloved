<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@preloved.goods'],
            [
                'name'     => 'preloved.g00ds Admin',
                'password' => Hash::make('preloved2024!'),
                'is_admin' => true,
            ]
        );
    }
}
