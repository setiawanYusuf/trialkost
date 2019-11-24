<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\User;

class KostTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kosts')->insert([
            'user_id' => 2,
            'name' => 'Data Dummy 1',
            'description' => 'Description Dummy 1',
            'price' => 1000000,
            'room' => 10,
            'booked_room' => 1,
            'city' => 'Malang',
            'image_url' => 'http://lorempixel.com/640/480/',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('kosts')->insert([
            'user_id' => 2,
            'name' => 'Data Dummy 2',
            'description' => 'Description Dummy 2',
            'price' => 500000,
            'room' => 8,
            'booked_room' => 2,
            'city' => 'Bandung',
            'image_url' => 'http://lorempixel.com/640/480/',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('kosts')->insert([
            'user_id' => 2,
            'name' => 'Data Dummy 3',
            'description' => 'Description Dummy 3',
            'price' => 350000,
            'room' => 5,
            'booked_room' => 3,
            'city' => 'Surabaya',
            'image_url' => 'http://lorempixel.com/640/480/',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
