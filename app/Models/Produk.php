<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';

    // Define the relationship to Hotel
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    // Define the relationship to TipeProduk
    public function tipeProduk()
    {
        return $this->belongsTo(TipeProduk::class, 'prodtipe_id');
    }

    public function transaksis(): BelongsToMany
    {
        return $this->belongsToMany(Transaksi::class, 'produk_transaksi', 'produk_id', 'transaksi_id');
    }
}
