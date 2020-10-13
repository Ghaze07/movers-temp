<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
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
                'name' => 'Pangasius Fish',
                'product_category_id' => 1,
                'status' => true,
            ]
        ];
        DB::table('products')->insert($data);
    }
}
