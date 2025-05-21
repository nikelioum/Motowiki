<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['bike_id', 'name', 'email', 'text', 'stars', 'status'];

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }
}
