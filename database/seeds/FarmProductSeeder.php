<?php

use Illuminate\Database\Seeder;

class FarmProductSeeder extends Seeder
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
                'farm_id' => 1,
                'product_id' => 1,
                'product_source_id' => 1,
                'unit_price' => '450',
                'measuring_unit_id' => 3,
                'status' => true,
            ]
        ];
        DB::table('farm_products')->insert($data);
    }
}