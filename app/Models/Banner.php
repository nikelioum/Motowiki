<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'position',
        'image',
        'title',
        'description',
        'button_text',
        'button_link',
    ];
}
