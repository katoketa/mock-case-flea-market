<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $params = [
            [
                'seller_id' => 1,
                'condition_id' => 1,
                'name' => '腕時計',
                'price' => 15000,
                'brand' => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'image' => 'images/腕時計.jpg',
            ],
            [
                'seller_id' => 2,
                'condition_id' => 2,
                'name' => 'HDD',
                'price' => 5000,
                'brand' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'image' => 'images/HDD.jpg',
            ],
            [
                'seller_id' => 3,
                'condition_id' => 3,
                'name' => '玉ねぎ3束',
                'price' => 300,
                'brand' => 'なし',
                'description' => '新鮮な玉ねぎ3束のセット',
                'image' => 'images/玉ねぎ3束.jpg',
            ],
            [
                'seller_id' => 4,
                'condition_id' => 4,
                'name' => '革靴',
                'price' => 4000,
                'brand' => '',
                'description' => 'クラシックなデザインの革靴',
                'image' => 'images/革靴.jpg',
            ],
            [
                'seller_id' => 5,
                'condition_id' => 1,
                'name' => 'ノートPC',
                'price' => 45000,
                'brand' => '',
                'description' => '高性能なノートパソコン',
                'image' => 'images/ノートPC.jpg',
            ],
            [
                'seller_id' => 6,
                'condition_id' => 2,
                'name' => 'マイク',
                'price' => 8000,
                'brand' => 'なし',
                'description' => '高音質のレコーディング用マイク',
                'image' => 'images/マイク.jpg',
            ],
            [
                'seller_id' => 7,
                'condition_id' => 3,
                'name' => 'ショルダーバッグ',
                'price' => 3500,
                'brand' => '',
                'description' => 'おしゃれなショルダーバッグ',
                'image' => 'images/ショルダーバッグ.jpg',
            ],
            [
                'seller_id' => 8,
                'condition_id' => 4,
                'name' => 'タンブラー',
                'price' => 500,
                'brand' => 'なし',
                'description' => '使いやすいタンブラー',
                'image' => 'images/タンブラー.jpg',
            ],
            [
                'seller_id' => 9,
                'condition_id' => 1,
                'name' => 'コーヒーミル',
                'price' => 4000,
                'brand' => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'image' => 'images/コーヒーミル.jpg',
            ],
            [
                'seller_id' => 10,
                'condition_id' => 2,
                'name' => 'メイクセット',
                'price' => 2500,
                'brand' => '',
                'description' => '便利なメイクアップセット',
                'image' => 'images/メイクセット.jpg',
            ],
        ];
        foreach ($params as $param) {
            DB::table('items')->insert($param);
        }
    }
}
