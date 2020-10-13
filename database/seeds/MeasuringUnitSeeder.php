<?php

use Illuminate\Database\Seeder;

class MeasuringUnitSeeder extends Seeder
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
                'name' => 'Per Each',
                'status' => true,
            ],
            [
                'name' => 'Gram',
                'status' => true,
            ],
            [
                'name' => 'Kg',
                'status' => true,
            ],
            [
                'name' => 'Maund (40Kg)',
                'status' => true,
            ],
            [
                'name' => 'Ton (1000 Kg)',
                'status' => true,
            ],
        ];
        DB::table('measuring_units')->insert($data);
    }
}
