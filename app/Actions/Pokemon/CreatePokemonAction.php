<?php

namespace App\Actions\Pokemon;

use App\Actions\Pokemon\Moves\CreateMoveAction;
use App\DTO\Pokemon\PokemonDTO;
use App\Models\Pokemon;
use Lorisleiva\Actions\Concerns\AsAction;

class CreatePokemonAction
{
    use AsAction;

    public function handle(PokemonDTO $pokemonData): Pokemon
    {
        $pokemon = Pokemon::create([
            'name' => $pokemonData->name,
            'current_hp' => $pokemonData->stats->hp,
            'hp' => $pokemonData->stats->hp,
            'attack' => $pokemonData->stats->attack,
            'defense' => $pokemonData->stats->defense,
            'speed' => $pokemonData->stats->speed,
            'special_attack' => $pokemonData->stats->specialAttack,
            'special_defense' => $pokemonData->stats->specialDefense,
            'types' => $pokemonData->types,
            'sprite' => $pokemonData->sprite,
        ]);

        foreach ($pokemonData->moves as $move) {
            $pokemon->moves()->attach(CreateMoveAction::run($move));
        }

        return $pokemon;
    }
}
