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
        DB::table('users')
                ->insert([
                    'name' => 'Steven Kristian Lokardo',
                    'email' => 'bangjago@admin.com',
                    'password' => '$2b$10$l0QNrdyuTqdsGsmaU0.cpOmaXm6p/z6BqE6t69bam11DkZ.LQDNjO',
                    //'$2b$10$JbFgZ1KRr6bn8EO2SDyohuKkUidpYbd7f53/aLUhOfIQKhALZD/BG', //bangjago123
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                ]);
    }
}
