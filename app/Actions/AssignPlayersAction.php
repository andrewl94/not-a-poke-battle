<?php

namespace App\Actions;

use App\Actions\Battle\CreateBattleAction;
use App\Actions\Pokemon\CreatePokemonAction;
use App\Actions\Pokemon\GetPokemonsForBattleAction;
use App\DTO\PlayerDTO;
use App\DTO\PlayersDTO;
use App\DTO\Pokemon\PokemonDTO;
use App\Models\Battle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\DataCollection;

class AssignPlayersAction
{
    use AsAction;

    public function handle(): Battle
    {
        $selectedPokemons = GetPokemonsForBattleAction::run();

        $battle = $this->createBattleWithSelectedPokemons($selectedPokemons);

        return $battle;
    }

    private function createBattleWithSelectedPokemons(DataCollection $selectedPokemons): Battle
    {

        $pokemons = $selectedPokemons->toArray();

        $mainPlayerPokemon = PokemonDTO::from(array_pop($pokemons));
        $mainPlayer = CreatePokemonAction::run($mainPlayerPokemon);

        $npcPokemon = PokemonDTO::from(array_pop($pokemons));
        $npc = CreatePokemonAction::run($npcPokemon);

        $battle = CreateBattleAction::run($mainPlayer, $npc);
        return $battle;
    }


    public function asController(Request $request)
    {
        $players = $this->handle();
        return response()->json($players);
    }
}
