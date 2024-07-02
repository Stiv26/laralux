<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk_transaksi')->insert([
            ['produk_id' => 1, 'transaksi_id' => 1, 'quantity' => 2, 'subtotal' => 1000000.00, 'created_at' => now(), 'updated_at' => now()],
            ['produk_id' => 2, 'transaksi_id' => 1, 'quantity' => 1, 'subtotal' => 800000.00, 'created_at' => now(), 'updated_at' => now()],
            ['produk_id' => 1, 'transaksi_id' => 2, 'quantity' => 1, 'subtotal' => 500000.00, 'created_at' => now(), 'updated_at' => now()],
            ['produk_id' => 2, 'transaksi_id' => 2, 'quantity' => 2, 'subtotal' => 1600000.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
