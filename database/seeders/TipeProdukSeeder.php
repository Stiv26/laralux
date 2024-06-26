<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipeproduks')->insert([
            ['nama' => 'Standard', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Deluxe', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Superior', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Suite', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Single Room', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Double Room', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Family Room', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
