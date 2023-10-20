<?php

namespace App\DTO\Pokemon;

use Spatie\LaravelData\Data;

class PokemonDTO extends Data
{
    public function __construct(
        public string $name,
        public PokemonInfoDTO $info,
    ) {
    }
}
