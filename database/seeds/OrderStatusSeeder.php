<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
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
                'status' => 'New'
            ],
            [
                'status' => 'Confirmed'
            ],
            [
                'status' => 'Dispatched'
            ],
            [
                'status' => 'Delivered'
            ],
            [
                'status' => 'Canceled'
            ],
            
        ];

        DB::table('order_statuses')->insert($data);
    }
}
