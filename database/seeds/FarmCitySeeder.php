<?php

use Illuminate\Database\Seeder;

class FarmCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = [
            [
                'city_id' => 1,
                'farm_id' => 1,
                'delivery_rate' => 200
            ],
            [
                'city_id' => 2,
                'farm_id' => 1,
                'delivery_rate' =>100
            ],
            [
                'city_id' => 3,
                'farm_id' => 1,
                'delivery_rate' =>100
            ],
            [
                'city_id' => 4,
                'farm_id' => 1,
                'delivery_rate' =>150
            ],
            [
                'city_id' => 5,
                'farm_id' => 1,
                'delivery_rate' =>200
            ],
            
        ];
        DB::table('farm_cities')->insert($data);
    }
}
