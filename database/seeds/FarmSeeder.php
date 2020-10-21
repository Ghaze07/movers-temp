<?php

use Illuminate\Database\Seeder;

class FarmSeeder extends Seeder
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
                'name' => 'Zaynab Fish Farm',
                'manager' => 'Muhammad Imran',
                'address' => 'Near Girls Primary School, Ganga Pind',
                'city_id' => 3,
                'email' => 'info@zaynabfishfarm.com',
                'mobile1' => '03215791371',
                'mobile2' => '03215791372',
                'status' => true,
            ]
        ];
        DB::table('farms')->insert($data);
    }
}