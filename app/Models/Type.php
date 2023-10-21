<?php

namespace App\Models;

use App\Enums\TypeEnum;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $casts = [
        'name' => TypeEnum::class,
        'is_physical' => 'boolean',
    ];

    protected $attributes = [
        'name' => null,
        'is_physical' => null,
    ];
}
