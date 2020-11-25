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
                'verification_code' => rand(1000, 9999)
            ],
            [
                'name' => 'Nouman Bashir',
                'email' => 'nouman@intercraftsol.com',
                'mobile' => 3369237827,
                'password' => Hash::make("Intercraft"),
                'role' => 'admin',
                'verification_code' => rand(1000, 9999)
            ],
            [
                'name' => 'Yousaf Arshad',
                'email' => 'yousaf@intercraftsol.com',
                'mobile' => 3125572494,
                'password' => Hash::make("Intercraft"),
                'role' => 'admin',
                'verification_code' => rand(1000, 9999)
            ],
            [
                'name' => 'Ghazi Khan',
                'email' => 'ghazi@intercraftsol.com',
                'mobile' => 3024024838,
                'password' => Hash::make("Intercraft"),
                'role' => 'customer',
                'verification_code' => rand(1000, 9999)
            ],
            [
                'name' => 'Farzam Ali',
                'email' => 'farzam@intercraftsol.com',
                'mobile' => 3415913031,
                'password' => Hash::make("Intercraft"),
                'role' => 'customer',
                'verification_code' => rand(1000, 9999)
            ]
        ];
        DB::table('users')->insert($data);
    }
}
