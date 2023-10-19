<?php

namespace App\Data\Pokemon\Moves;

use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;

class MoveEndpoint extends Data
{
    public function __construct(
        public string $name,
        #[Regex('/^https:\/\/pokeapi\.co\/api\/v2\/move\/[0-9]{1,6}\//')]
        public string $url,
    ) {
    }
}
