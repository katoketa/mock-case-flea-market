<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'buyer_id' => 3,
            'item_id' => 1,
            'postal_code' => '789-1011',
            'address' => '群馬県盛岡市10-11',
            'building' => '',
        ];
        DB::table('purchase_histories')->insert($param);
    }
}
