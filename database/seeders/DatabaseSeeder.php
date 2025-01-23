<?php

namespace Database\Seeders;

use App\Models\Auction;
use App\Models\Item;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@curotec.com',
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'user01',
            'email' => 'user01@curotec.com',
        ]);

        User::factory()->create([
            'name' => 'user02',
            'email' => 'user02@curotec.com',
        ]);

        Auction::factory()
            ->count(5)
            ->active()
            ->create();

        Item::factory()
            ->count(5)
            ->create();
    }
}
