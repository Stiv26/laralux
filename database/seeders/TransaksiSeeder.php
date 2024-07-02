<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi')->insert([
            ['user_id' => 3, 'waktu_transaksi' => now(), 'created_at' => now(), 'updated_at' => now(), 'total' => 1998000, 'total_tanpa_pajak' => 1800000],
            ['user_id' => 3, 'waktu_transaksi' => now(), 'created_at' => now(), 'updated_at' => now(), 'total' => 2331000, 'total_tanpa_pajak' => 2100000]
        ]);
    }
}
