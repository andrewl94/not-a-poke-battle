<?php
namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class PokemonList extends Data
{
    public function __construct(
        #[DataCollectionOf(Pokemon::class)]
        public DataCollection $pokemons,
    ) {
    }
}
