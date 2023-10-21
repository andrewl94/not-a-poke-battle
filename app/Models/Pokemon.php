<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'types' => 'array',
    ];

    protected $attributes = [
        'name' => null,
        'current_hp' => null,
        'hp' => null,
        'attack' => null,
        'defense' => null,
        'speed' => null,
        'special_attack' => null,
        'special_defense' => null,
        'types' => null,
        'sprite' => null,
    ];

    public function moves()
    {
        return $this->belongsToMany(Move::class);
    }

    public function battle()
    {
        return $this->hasOne(Battle::class);
    }
}
