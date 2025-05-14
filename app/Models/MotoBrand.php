<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotoBrand extends Model
{
    /** @use HasFactory<\Database\Factories\MotoBrandFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'slug',
        'meta_title',
        'meta_description',
        'meta_image',
        'status',
    ];
}
