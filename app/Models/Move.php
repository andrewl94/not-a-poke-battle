<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'id' => null,
        'name' => null,
        'power' => null,
        'pp' => null,
        'type' => null,
    ];

    public function pokemon()
    {
        return $this->belongsToMany(Pokemon::class);
    }
}
