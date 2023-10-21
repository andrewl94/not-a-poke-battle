<?php

namespace App\Actions\Pokemon;

use App\DTO\Pokemon\PokemonDTO;
use App\Models\Pokemon;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePokemonDTOFromPokemonModelAction
{
    use AsAction;

    public function handle(Pokemon $pokemon): PokemonDTO
    {
        return PokemonDTO::from([
            "id" => $pokemon->id,
            "name" => $pokemon->name,
            "stats" => [
                "currentHp" => $pokemon->current_hp,
                "hp" => $pokemon->hp,
                "attack" => $pokemon->attack,
                "defense" => $pokemon->defense,
                "speed" => $pokemon->speed,
                "specialAttack" => $pokemon->special_attack,
                "specialDefense" => $pokemon->special_defense,
            ],
            "moves" => $pokemon->moves,
            "sprite" => $pokemon->sprite,
            "types" => $pokemon->types,
        ]);
    }
}
