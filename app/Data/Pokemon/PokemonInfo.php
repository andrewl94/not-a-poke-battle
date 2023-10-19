<?php

namespace App\Data\Pokemon;

use App\Data\Pokemon\Moves\MoveData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class PokemonInfo extends Data
{
    public function __construct(
        public PokemonStatus $stats,
        #[DataCollectionOf(MoveData::class)]
        public DataCollection $moves,
        public array $types,
        public string $sprite
    ) {
    }
}
