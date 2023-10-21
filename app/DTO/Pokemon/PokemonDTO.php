<?php

namespace App\DTO\Pokemon;

use App\DTO\Pokemon\Moves\MoveDataDTO;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class PokemonDTO extends Data
{
    public function __construct(
        public int $id,

        public string $name,
        /** @var \App\DTO\Pokemon\PokemonStatusDTO */
        public PokemonStatusDTO $stats,

        #[DataCollectionOf(MoveDataDTO::class)]
        public DataCollection $moves,

        public array $types,

        public string $sprite
    ) {
    }
}
