<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'images',
        'price'
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
