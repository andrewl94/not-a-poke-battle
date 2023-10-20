<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PokemonMove extends Model
{
    protected $guarded = ["id"];

    protected $attributes = [
        'pokemon_id' => null,
        'name' => null,
        'power' => null,
        'pp' => null,
        'type' => null,
    ];

    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }
}
