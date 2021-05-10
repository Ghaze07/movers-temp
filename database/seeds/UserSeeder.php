<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'name' => 'Shameen',
                'email' => 'sahameen@smallhaul.com',
                'mobile' => 3024024883,
                'password' => Hash::make("Smallhaul"),
                'role' => 'admin',
                'verification_code' => rand(1000, 9999)
            ],
        ];
        DB::table('users')->insert($data);
    }
}
