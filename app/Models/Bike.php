<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    /** @use HasFactory<\Database\Factories\BikeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'category_id',
        'year',
        'price',
        'image',
        'description',
        'meta_title',
        'meta_description',
        'meta_image',
        'status',
    ];

    public function brand()
    {
        return $this->belongsTo(MotoBrand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(MotoCategory::class, 'category_id');
    }

    public function specValues()
    {
        return $this->hasMany(\App\Models\BikeSpecValue::class, 'bike_id');
    }
}
