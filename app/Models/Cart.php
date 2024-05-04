<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Declaration
    protected $fillable = [
        'cart_id',
        'user_id',
        'product_id',
        'quantity',
    ];
}
