<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Declaration
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'waiting_time',
        'view_count'
    ];
}
