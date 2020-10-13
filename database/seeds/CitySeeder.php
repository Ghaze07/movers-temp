<?php

use Illuminate\Database\Seeder;

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
                'region_id' => 1,
                'status' => true,
            ],
            [
                'name' => 'Wah Cantt',
                'region_id' => 2,
                'status' => true,
            ],
            [
                'name' => 'Hassan Abdal',
                'region_id' => 3,
                'status' => true,
            ],
            [
                'name' => 'Taxila',
                'region_id' => 2,
                'status' => true,
            ],
            [
                'name' => 'Rawalpindi',
                'region_id' => 2,
                'status' => true,
            ],
        ];
        DB::table('cities')->insert($data);
    }
}
