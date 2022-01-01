<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create product
        DB::table('products')->insert([
            'name' => "product 1",
            'price' => 100,
            'restaurant_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        //create product
        DB::table('products')->insert([
            'name' => "product 2",
            'price' => 120,
            'restaurant_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        //create product
        DB::table('products')->insert([
            'name' => "product 3",
            'price' => 130,
            'restaurant_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        //create product
        DB::table('products')->insert([
            'name' => "product 4",
            'price' => 140,
            'restaurant_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
    }
}
