<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'expiration',
        'txid',
        'loc_id',
        'loc',
        'status',
        'ammount',
        'pix_key'
    ];
}
