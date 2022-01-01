<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create restaurant
        DB::table('restaurants')->insert([
            'name' => "restaurant1",
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
        //create restaurant
        DB::table('restaurants')->insert([
            'name' => "restaurant2",
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
    }
}
