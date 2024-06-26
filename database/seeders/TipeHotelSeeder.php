<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipehotels')->insert([
            ['nama' => 'City Hotel', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Residential Hotel', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Motel', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
