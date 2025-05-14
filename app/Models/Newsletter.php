<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = ['name', 'email', 'accepted_terms', 'unsubscribe_token'];
}
