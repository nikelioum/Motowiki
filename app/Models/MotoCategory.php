<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotoCategory extends Model
{
    /** @use HasFactory<\Database\Factories\MotoCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'slug',
        'meta_title',
        'meta_description',
        'meta_image',
        'status',
        'sort_order',
        'is_show',
        'is_popular',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(MotoCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MotoCategory::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}
