<?php

namespace App\Actions;

use App\Actions\Battle\CreateBattleAction;
use App\Actions\Pokemon\CreatePokemonAction;
use App\Actions\Pokemon\GetPokemonsForBattleAction;
use App\DTO\BattleStateDTO;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\DataCollection;

class StartBattleAction
{
    use AsAction;

    public function handle(): BattleStateDTO
    {
        $selectedPokemons = GetPokemonsForBattleAction::run();

        $battle = $this->createBattleWithSelectedPokemons($selectedPokemons);

        return $battle;
    }

    private function createBattleWithSelectedPokemons(DataCollection $selectedPokemons): BattleStateDTO
    {
        $pokemons = collect($selectedPokemons->toCollection());

        $playerPokemon = $pokemons->pop();

        $mainPlayer = CreatePokemonAction::run($playerPokemon);

        $npcPokemon = $pokemons->pop();

        $npc = CreatePokemonAction::run($npcPokemon);

        $battle = CreateBattleAction::run($mainPlayer, $npc);

        return new BattleStateDTO(id: $battle->id, playerPokemon: $playerPokemon, npcPokemon: $npcPokemon);
    }
}
