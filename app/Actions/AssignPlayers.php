<?php

namespace App\Actions;

use App\Actions\Pokemon\GetPokemonList;
use App\Data\Players;
use Exception;
use Illuminate\Http\Request;

use Lorisleiva\Actions\Concerns\AsAction;

class AssignPlayers
{
    use AsAction;

    public function handle()
    {
        $selectedPokemons = GetPokemonList::run();

        $pokemons = $selectedPokemons->toArray();

        try {
            $mainPlayer = Players::validateAndCreate([
                "human" => true,
                "pokemon" => array_pop($pokemons)
            ]);

            $npc = Players::validateAndCreate([
                "human" => false,
                "pokemon" => array_pop($pokemons)
            ]);
        } catch (\Throwable $th) {
            throw new Exception("Unable to create players");
        }

        return [
            'mainPlayer' => $mainPlayer,
            'npc' => $npc
        ];
    }

    public function asController(Request $request)
    {
        $candidate = $this->handle();

        return response()->json($candidate);
    }
}
