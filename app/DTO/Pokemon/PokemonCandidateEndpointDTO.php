<?php

namespace App\DTO\Pokemon;

use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;

class PokemonCandidateEndpointDTO extends Data
{
    public function __construct(
        public string $name,
        #[Regex('/^https:\/\/pokeapi\.co\/api\/v2\/pokemon\/[0-9]{1,6}\//')]
        public string $url,
    ) {
    }

}
