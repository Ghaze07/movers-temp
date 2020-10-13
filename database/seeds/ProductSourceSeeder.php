<?php

use Illuminate\Database\Seeder;

class ProductSourceSeeder extends Seeder
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
                'source' => 'Factory',
                'status' => true,
            ],
            [
                'source' => 'Fish Farm',
                'status' => true,
            ],
            [
                'source' => 'River',
                'status' => true,
            ],
            [
                'source' => 'Dam',
                'status' => true,
            ],
            [
                'source' => 'Biofloc',
                'status' => true,
            ],
            [
                'source' => 'Sea',
                'status' => true,
            ],
            [
                'source' => 'Cage Culture',
                'status' => true,
            ],
            [
                'source' => 'Store',
                'status' => true,
            ]
        ];
        DB::table('product_sources')->insert($data);
    }
}
