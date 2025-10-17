<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counselor extends Model
{
    protected $fillable = [
        'name',
        'title',
        'category',
        'photo',
        'organization',
        'tags',
        'availability_status',
        'available_date',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}