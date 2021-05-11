<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightSeeder extends Seeder
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
                'name' => 'There is an elevator available',
                'charges'=> '0',
            ],
            [
                'name' => 'Ground Floor',
                'charges'=> '50',
            ],
            [
                'name' => '1 flight',
                'charges'=> '100',
            ],
            [
                'name' => '2 flights',
                'charges'=> '150',
            ],
            [
                'name' => '3 flights',
                'charges'=> '200',
            ],
            [
                'name' => '4 flights',
                'charges'=> '250',
            ],
            [
                'name' => '5 flights',
                'charges'=> '300',
            ],
            [
                'name' => 'other',
                'charges'=> '500',
            ],
        ];
        
        DB::table('flights')->insert($data);
    }
}
