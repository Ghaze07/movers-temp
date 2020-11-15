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
                'user_id' => 2,
                'city_id' => 5,
                'complete_address' => 'Office S09 2nd floor, Goldpoint Mall Waris Khan, Rawalpindi'
            ]
        ];

        DB::table('addresses')->insert($data);
    }
}
