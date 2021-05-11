<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParkingSeeder extends Seeder
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
                'name' => 'Loading dock will be reserved',
                'charges'=> '200',
            ],
            [
                'name' => 'Parking permit will be pulled',
                'charges'=> '250',
            ],
            [
                'name' => 'Metered parking available ',
                'charges'=> '300',
            ],
            [
                'name' => 'Commercial parking available',
                'charges'=> '0',
            ],
            [
                'name' => 'Easy street parking available',
                'charges'=> '0',
            ],
            [
                'name' => 'Home driveway available',
                'charges'=> '0',
            ],
        ];
        
        DB::table('parkings')->insert($data);
    }
}
