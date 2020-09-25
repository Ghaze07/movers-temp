<?php

use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
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
                'name_en' => 'Syed Adeel Hassan',
                'title_en' => 'Fisheries and Aquaculture Expert.',
                'name_ur' => 'سید عدیل حسن',
                'title_ur' => 'فشریز اینڈ ایکوا کلچر ایکسپرٹ',
                'photo' => 'Syed_Adeel_Hassan.jpg'
            ]
        ];

        DB::table('authors')->insert($data);
    }
}
