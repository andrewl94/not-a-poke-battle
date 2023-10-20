<?php

namespace App\DTO;

use App\DTO\Pokemon\PokemonDTO;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;

class PlayersDTO extends Data
{
    public function __construct(
        public PokemonDTO $pokemon,
        public bool $human,
    ) {
    }
}
