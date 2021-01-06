<?php

use Illuminate\Database\Seeder;

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
                'image_title' => 'item_removal',
                'first_trait' => 'Recycling',
                'second_trait' => 'Upcycling',
                'third_trait' => 'Donations',
                'status' => true,
            ],
            [
                'name' => 'Labor Only',
                'image_title' => 'labor_only',
                'first_trait' => 'In-Home Moves',
                'second_trait' => 'Rearrangment',
                'third_trait' => 'In-Building Moves',
                'status' => true,
            ],
            [
                'name' => 'Large Moves',
                'image_title' => 'large_moves',
                'first_trait' => '1 Large Bedroom',
                'second_trait' => '2 Bedroom',
                'third_trait' => 'Specialty Items',
                'status' => true,
            ],
            [
                'name' => 'Micro Moves',
                'image_title' => 'micro_moves',
                'first_trait' => 'Courier Service',
                'second_trait' => '1 Hauler + You',
                'third_trait' => 'Extra Muscle',
                'status' => true,
            ],
            [
                'name' => 'Small Moves',
                'image_title' => 'small_moves',
                'first_trait' => '1-3 Large Items',
                'second_trait' => 'Studio - 1 Bedroom',
                'third_trait' => 'Extra Muscle',
                'status' => true,
            ],
            [
                'name' => 'Storage Services',
                'image_title' => 'storage_services',
                'first_trait' => 'Pickup/Store',
                'second_trait' => 'Unit Set-Up',
                'third_trait' => 'Redelivery',
                'status' => true,
            ],
        ];

        DB::table('services')->insert($data);
    }
}
