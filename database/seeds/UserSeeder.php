<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create user
        DB::table('users')->insert([
            'username' => "user1",
            'email' => "user1@gmail.com",
            'password' => bcrypt("12345678"),
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        //create user
        DB::table('users')->insert([
            'username' => "user2",
            'email' => "user2@gmail.com",
            'password' => bcrypt("12345678"),
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
    }
}
