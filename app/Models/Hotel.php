<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{ 
    use HasFactory;
    protected $table = 'hotels';

    // Define the relationship to TipeHotel
    public function tipeHotel()
    {
        return $this->belongsTo(TipeHotel::class, 'hoteltipe_id');
    }

    // Define the relationship to Produk
    public function produks()
    {
        return $this->hasMany(Produk::class, 'hotel_id');
    }
}
