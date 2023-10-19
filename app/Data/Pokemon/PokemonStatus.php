<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;

class PokemonStatus extends Data
{
    public function __construct(
        public int $hp,
        public int $attack,
        public int $defense,
        public int $speed,
        public int $specialattack,
        public int $specialdefense,
    ) {
    }
}
