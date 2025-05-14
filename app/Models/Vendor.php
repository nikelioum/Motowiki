<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        'image',
        'phone',
        'email',
        'website',
        'state',
        'address',
        'lat',
        'lng',
        'state',
    ];

    /**
     * Get the brand that the vendor is associated with.
     */
    public function brand()
    {
        return $this->belongsTo(MotoBrand::class);
    }
}
