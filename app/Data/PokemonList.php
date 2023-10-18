<?php
namespace App\Data;

use Spatie\LaravelData\Data;

class PokemonList extends Data
{
    public function __construct(
        public array $results,
    ) {
    }
}
