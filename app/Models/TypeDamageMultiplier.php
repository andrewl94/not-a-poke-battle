<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeDamageMultiplier extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        "multiplier" => "float"
    ];

    protected $attributes = [
        'actor_type' => null,
        'target_type' => null,
        'multiplier' => null,
    ];
}
