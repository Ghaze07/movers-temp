<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Islamabad',
                'name_abbreviation'=> 'ISB',
                'region_id' => 1,
                'status' => true,
            ],
            [
                'name' => 'Wah Cantt',
                'name_abbreviation'=> 'WAH',
                'region_id' => 2,
                'status' => true,
            ],
            [
                'name' => 'Hassan Abdal',
                'name_abbreviation'=> 'HBD',
                'region_id' => 2,
                'status' => true,
            ],
            [
                'name' => 'Taxila',
                'name_abbreviation'=> 'TXL',
                'region_id' => 2,
                'status' => true,
            ],
            [
                'name' => 'Rawalpindi',
                'name_abbreviation'=> 'RWP',
                'region_id' => 2,
                'status' => true,
            ],
        ];
        DB::table('cities')->insert($data);
    }
}
