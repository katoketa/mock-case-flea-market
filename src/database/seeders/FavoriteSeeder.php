<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $params = [
            [
                'user_id' => 1,
                'item_id' => 5,
            ],
            [
                'user_id' => 1,
                'item_id' => 1,
            ],
            [
                'user_id' => 2,
                'item_id' => 5,
            ],
            [
                'user_id' => 3,
                'item_id' => 10,
            ],
            [
                'user_id' => 4,
                'item_id' => 5,
            ],
            [
                'user_id' => 5,
                'item_id' => 1,
            ],
            [
                'user_id' => 6,
                'item_id' => 5,
            ],
            [
                'user_id' => 7,
                'item_id' => 6,
            ],
            [
                'user_id' => 8,
                'item_id' => 3,
            ],
            [
                'user_id' => 9,
                'item_id' => 1,
            ],
            [
                'user_id' => 10,
                'item_id' => 2,
            ],
        ];
        foreach ($params as $param) {
            DB::table('favorites')->insert($param);
        }
    }
}
