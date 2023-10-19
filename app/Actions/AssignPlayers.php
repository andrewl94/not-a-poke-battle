<?php

namespace App\Actions;

use App\Actions\Pokemon\GetPokemonList;
use App\Data\Players;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class AssignPlayers
{
    use AsAction;

    public function handle()
    {


        try {
            $selectedPokemons = GetPokemonList::run();

            $pokemons = $selectedPokemons->toArray();
            $mainPlayer = Players::validateAndCreate([
                "human" => true,
                "pokemon" => array_pop($pokemons)
            ]);

            $npc = Players::validateAndCreate([
                "human" => false,
                "pokemon" => array_pop($pokemons)
            ]);

            return [
                'mainPlayer' => $mainPlayer,
                'npc' => $npc
            ];
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            throw new Exception("Unable to create players");
        }
    }

    public function asController(Request $request)
    {
        try {
            $players = $this->handle();
            return response()->json($players);
        } catch (\Throwable $th) {
            return response()->json("Try again later.",400);
        }
    }
}
