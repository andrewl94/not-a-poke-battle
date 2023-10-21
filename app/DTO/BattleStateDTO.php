<?php

namespace App\DTO;

use App\DTO\Pokemon\PokemonDTO;
use Spatie\LaravelData\Data;

class BattleStateDTO extends Data
{
    public function __construct(
        public int $id,
        public PokemonDTO $playerPokemon,
        public PokemonDTO $npcPokemon,
    ) {
    }
}
