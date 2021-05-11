<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
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
                'name' => 'Item Removal',
                'image' => '/uploads/item_removal.png',
                'first_trait' => 'Recycling',
                'second_trait' => 'Upcycling',
                'third_trait' => 'Donations',
                'charges' => '100',
                'status' => true,
            ],
            [
                'name' => 'Labor Only',
                'image' => '/uploads/labor_only.png',
                'first_trait' => 'In-Home Moves',
                'second_trait' => 'Rearrangment',
                'third_trait' => 'In-Building Moves',
                'charges' => '200',
                'status' => true,
            ],
            [
                'name' => 'Large Moves',
                'image' => '/uploads/large_move.png',
                'first_trait' => '1 Large Bedroom',
                'second_trait' => '2 Bedroom',
                'third_trait' => 'Specialty Items',
                'charges' => '300',
                'status' => true,
            ],
            [
                'name' => 'Micro Moves',
                'image' => '/uploads/micro_move.png',
                'first_trait' => 'Courier Service',
                'second_trait' => '1 Hauler + You',
                'third_trait' => 'Extra Muscle',
                'charges' => '400',
                'status' => true,
            ],
            [
                'name' => 'Small Moves',
                'image' => '/uploads/small_move.png',
                'first_trait' => '1-3 Large Items',
                'second_trait' => 'Studio - 1 Bedroom',
                'third_trait' => 'Extra Muscle',
                'charges' => '500',
                'status' => true,
            ],
            [
                'name' => 'Storage Services',
                'image' => '/uploads/storage_service.png',
                'first_trait' => 'Pickup/Store',
                'second_trait' => 'Unit Set-Up',
                'third_trait' => 'Redelivery',
                'charges' => '600',
                'status' => true,
            ],
        ];

        DB::table('services')->insert($data);
    }
}
