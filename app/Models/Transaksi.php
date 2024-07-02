<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pembeli(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembeli_id');
    }

    public function produks() : BelongsToMany
    {
        return $this->belongsToMany(Produk::class, 'produk_transaksi', 'transaksi_id', 'produk_id')
        ->withPivot('quantity', 'subtotal');
    }
}
