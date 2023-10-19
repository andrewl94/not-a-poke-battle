<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;

class Pokemon extends Data
{
    public function __construct(
        public string $name,
        public PokemonInfo $info,
    ) {
    }
}
