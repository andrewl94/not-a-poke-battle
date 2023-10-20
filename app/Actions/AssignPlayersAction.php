<?php

namespace App\Actions;

use App\Actions\Pokemon\GetPokemonsForBattleAction;
use App\DTO\PlayersDTO;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class AssignPlayersAction
{
    use AsAction;

    public function handle()
    {
        $selectedPokemons = GetPokemonsForBattleAction::run();

        $pokemons = $selectedPokemons->toArray();

        $mainPlayer = PlayersDTO::validateAndCreate([
            "human" => true,
            "pokemon" => array_pop($pokemons)
        ]);

        $npc = PlayersDTO::validateAndCreate([
            "human" => false,
            "pokemon" => array_pop($pokemons)
        ]);

        return [
            'mainPlayer' => $mainPlayer,
            'npc' => $npc
        ];
    }

    public function asController(Request $request)
    {
        $players = $this->handle();
        return response()->json($players);
    }
}
