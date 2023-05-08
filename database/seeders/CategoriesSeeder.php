<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataSeeders = [
            [
                'category_name' => 'Sofa',
                'created_At' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Bàn',
                'created_At' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Ghế ',
                'created_At' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Tủ ',
                'created_At' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_name' => 'Giường',
                'created_At' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('categories')->insert($dataSeeders);
    }
}
