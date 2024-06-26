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
                'gambar'=> 'https://assets.alooz.id/elhotel/1ee4e5eb-1dd8-4e60-8aee-2dae8fd9c144.png',
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
                'gambar'=> 'https://assets.alooz.id/elhotel/e2b6a71c-f6b3-4dc9-8335-c0df2875b668.jpeg',
                'hoteltipe_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
