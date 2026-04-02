<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Profile::factory(10)->create();

        $this->call(CategorySeeder::class);
        $this->call(ConditionSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(CategoryItemSeeder::class);
        $this->call(PurchaseHistorySeeder::class);
        $this->call(FavoriteSeeder::class);

        Comment::factory(100)->create();
    }
}
