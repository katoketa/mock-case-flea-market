<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $params = [
            [
                'name' => '良好'
            ],
            [
                'name' => '目立った傷や汚れなし'
            ],
            [
                'name' => 'やや傷や汚れあり'
            ],
            [
                'name' => '状態が悪い'
            ],
        ];
        foreach ($params as $param) {
            DB::table('conditions')->insert($param);
        }
    }
}
