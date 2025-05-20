<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slider extends Model
{
    protected $fillable = ['name'];

    public function slides(): HasMany
    {
        return $this->hasMany(Slide::class)->orderBy('sort_order', 'desc');
    }
}
