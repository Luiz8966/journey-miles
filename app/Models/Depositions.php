<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depositions extends Model
{
    use HasFactory;

    protected $fillable = [
        'persons_name',
        'deposition',
        'photo_path',
    ];
}
