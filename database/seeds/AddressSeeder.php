<?php

use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
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
                'user_id' => 1,
                'city_id' => 2,
                'complete_address' => 'Main chowk Wah Cantt'
            ],
            [
                'user_id' => 2,
                'city_id' => 3,
                'complete_address' => 'Main chowk Hassan Abdal'
            ],
            [
                'user_id' => 3,
                'city_id' => 5,
                'complete_address' => 'Office S09 2nd floor, Goldpoint Mall Waris Khan, Rawalpindi'
            ],
            [
                'user_id' => 3,
                'city_id' => 5,
                'complete_address' => 'Near Chaman Ice cream, Commercial Market, Rawalpindi'
            ],
            [
                'user_id' => 4,
                'city_id' => 5,
                'complete_address' => 'Office S09 2nd floor, Goldpoint Mall Waris Khan, Rawalpindi'
            ],
            [
                'user_id' => 4,
                'city_id' => 5,
                'complete_address' => 'Near Al Jannat Mall, Commercial Market, Rawalpindi'
            ],
            [
                'user_id' => 5,
                'city_id' => 5,
                'complete_address' => 'Office S09 2nd floor, Goldpoint Mall Waris Khan, Rawalpindi'
            ],
            [
                'user_id' => 5,
                'city_id' => 5,
                'complete_address' => 'Commercial Market, Rawalpindi'
            ]
        ];

        DB::table('addresses')->insert($data);
    }
}
