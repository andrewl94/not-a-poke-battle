<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Battle extends Model
{
    protected $guarded = ['id'];

    protected $attributes = [
        'player_pokemon_id' => null,
        'npc_pokemon_id' => null,
    ];

    public function playerPokemon(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class);
    }

    public function npcPokemon(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class);
    }
}
