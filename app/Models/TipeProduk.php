<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeProduk extends Model
{
    use HasFactory;
    protected $table = 'tipeproduks';

    public function produks()
    {
        return $this->hasMany(Produk::class, 'prodtipe_id');
    }
}
