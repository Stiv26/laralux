<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotels')->insert([
            [
                'nama' => 'Hotel A',
                'alamat' => 'Address 1',
                'nomortelpon' => '084365273812',
                'email' => 'hotelA@example.com',
                'rating' => 5,
                'hoteltipe_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Hotel B',
                'alamat' => 'Address 2',
                'nomortelpon' => '081267343134',
                'email' => 'hotelB@example.com',
                'rating' => 4,
                'hoteltipe_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
