<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Declaration;

class Rating extends Model
{
    use HasFactory;

    // Declaration
    protected $fillable = [
        'user_id',
        'product_id',
        'rating_count',
        'message',
    ];
}
