<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    protected $guarded = ["id"];

    protected $attributes = [
        'player_pokemon_id' => null,
        'npc_pokemon_id' => null,
    ];

    public function playerPokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }

    public function npcPokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }
}
