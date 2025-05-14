<?php

namespace App\Models;

use App\Enum\SpecAttributeType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    use HasFactory;

    protected $fillable = [
        'spec_category_id',
        'name',
        'label',
        'type',
    ];

    /**
     * Cast 'type' to enum
     */
    protected $casts = [
        'type' => SpecAttributeType::class,
    ];

    /**
     * Get the category this spec belongs to.
     */
    public function specCategory()
    {
        return $this->belongsTo(SpecCategory::class);
    }
}
