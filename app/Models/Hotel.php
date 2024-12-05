<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'price_per_night',
        'image',
        'is_featured',
        'amenities',
        'rating'
    ];

    protected $casts = [
        'amenities' => 'array',
        'is_featured' => 'boolean',
        'price_per_night' => 'decimal:2'
    ];
}
