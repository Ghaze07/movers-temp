<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
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
                'name' => 'Federal Area',
                'country_id' => 1,
                'status' => true,
            ],
            [
                'name' => 'Punjab',
                'country_id' => 1,
                'status' => true,
            ],
            [
                'name' => 'KPK',
                'country_id' => 1,
                'status' => true,
            ],
            [
                'name' => 'Sindh',
                'country_id' => 1,
                'status' => false,
            ],
            [
                'name' => 'Balochistan',
                'country_id' => 1,
                'status' => false,
            ],
            [
                'name' => 'AJK',
                'country_id' => 1,
                'status' => false,
            ],
        ];
        DB::table('regions')->insert($data);
    }
}
