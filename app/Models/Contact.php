<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Declaration;

class Contact extends Model
{
    use HasFactory;

    // Declaration
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
