<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
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
                'name' => 'Pakistan',
                'short_name' => 'PK',
                'status' => true,
            ]
        ];
        DB::table('countries')->insert($data);
    }
}
