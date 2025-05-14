<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeSpecValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_id',
        'spec_id',
        'value',
    ];

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }

    public function spec()
    {
        return $this->belongsTo(Spec::class);
    }
}
