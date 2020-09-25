<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
                'name' => 'Khyam Shahzad',
                'email' => 'kshahzad@intercraftsol.com',
                'mobile' => 3215791371,
                'password' => Hash::make("Intercraft"),
                'role' => 'admin',
            ]
        ];
        DB::table('users')->insert($data);
    }
}
