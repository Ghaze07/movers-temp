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
                'name' => 'M. Usman Bhatti',
                'email' => 'mubhatti@intercraftsol.com',
                'mobile' => 3495101066,
                'password' => Hash::make("Intercraftsol"),
                'role' => 'admin',
            ]
        ];
        DB::table('users')->insert($data);
    }
}
