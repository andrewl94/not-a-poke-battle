<?php

namespace App\Actions\Battle;

use App\Models\Battle;
use App\Models\Pokemon;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateBattleAction
{
    use AsAction;

    public function handle(Pokemon $playerPokemon, Pokemon $npcPokemon): Battle
    {
        return Battle::create([
            'player_pokemon_id' => $playerPokemon->id,
            'npc_pokemon_id' => $npcPokemon->id,
        ]);
    }
}
