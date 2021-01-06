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
