<?php

namespace App\DTO\Pokemon;

use Spatie\LaravelData\Data;

class PokemonStatusDTO extends Data
{
    public function __construct(

        public int $currentHp,
        public int $hp,
        public int $attack,
        public int $defense,
        public int $speed,
        public int $specialAttack,
        public int $specialDefense,
    ) {
    }
}
