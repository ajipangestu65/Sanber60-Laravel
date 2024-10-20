<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->admin()
            ->create([
                'name'  => 'Admin',
                'email' => 'admin@perpus.com',
            ]);

        Category::factory()
            ->count(10)
            ->create();
    }
}
