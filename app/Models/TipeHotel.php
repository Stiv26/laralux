<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeHotel extends Model
{
    use HasFactory;
    protected $table = 'tipehotels';

    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'hoteltipe_id');
    }
}
