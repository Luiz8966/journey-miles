<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'persons_name',
        'testimonial',
        'photo_path',
    ];

    protected $casts = ['created_at' => 'datetime', 'updated_at' => 'datetime'];
}
