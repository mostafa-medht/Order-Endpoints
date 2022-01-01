<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin
        DB::table('admins')->insert([
            'username' => "admin1",
            'password' => bcrypt("12345678"),
            'email' => "admin1@gmail.com",
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        //create admin
        DB::table('admins')->insert([
            'username' => "admin2",
            'password' => bcrypt("12345678"),
            'email' => "admin2@gmail.com",
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
    }
}
