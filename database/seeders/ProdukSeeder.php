<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produks')->insert([
            [
                'nama' => 'Standard Room',
                'hotel_id' => 1,
                'prodtipe_id' => 1,
                'harga' => 500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Deluxe Room',
                'hotel_id' => 1,
                'prodtipe_id' => 2,
                'harga' => 800000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Suite Room',
                'hotel_id' => 2,
                'prodtipe_id' => 4,
                'harga' => 1200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
