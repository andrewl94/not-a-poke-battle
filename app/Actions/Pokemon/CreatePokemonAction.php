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
        $pokemonModel = Pokemon::create([
            "name" => $pokemonData->name,
            "current_hp" => $pokemonData->info->stats->hp,
            "hp" => $pokemonData->info->stats->hp,
            "attack" => $pokemonData->info->stats->attack,
            "defense" => $pokemonData->info->stats->defense,
            "speed" => $pokemonData->info->stats->speed,
            "special_attack" => $pokemonData->info->stats->specialAttack,
            "special_defense" => $pokemonData->info->stats->specialDefense,
            "types" => $pokemonData->info->types,
            "sprite" => $pokemonData->info->sprite,
        ]);

        foreach ($pokemonData->info->moves as $move) {
            CreateMoveAction::run($pokemonModel, $move);
        }

        return Pokemon::find($pokemonModel->id);
    }
}
