<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Declaration;

class Order extends Model
{
    use HasFactory;

    // Declaration
    protected $fillable = [
        'user_id',
        'order_code',
        'total_price',
        'status',
    ];
}
