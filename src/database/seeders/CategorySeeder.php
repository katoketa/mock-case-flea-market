<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $params = [
            [
                // 1
                'name' => 'ファッション'
            ],
            [
                // 2
                'name' => '家電'
            ],
            [
                // 3
                'name' => 'インテリア'
            ],
            [
                // 4
                'name' => 'レディース'
            ],
            [
                // 5
                'name' => 'メンズ'
            ],
            [
                // 6
                'name' => 'コスメ'
            ],
            [
                // 7
                'name' => '本'
            ],
            [
                // 8
                'name' => 'ゲーム'
            ],
            [
                // 9
                'name' => 'スポーツ'
            ],
            [
                // 10
                'name' => 'キッチン'
            ],
            [
                // 11
                'name' => 'ハンドメイド'
            ],
            [
                // 12
                'name' => 'アクセサリー'
            ],
            [
                // 13
                'name' => 'おもちゃ'
            ],
            [
                // 14
                'name' => 'ベビー・キッズ'
            ],
        ];
        foreach ($params as $param) {
            DB::table('categories')->insert($param);
        }
    }
}
