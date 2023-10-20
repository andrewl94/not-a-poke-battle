<?php

namespace App\DTO\Pokemon;

use App\DTO\Pokemon\Moves\MoveDataDTO;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class PokemonInfoDTO extends Data
{
    public function __construct(

        /** @var \App\DTO\Pokemon\PokemonStatusDTO */
        public PokemonStatusDTO $stats,

        #[DataCollectionOf(MoveDataDTO::class)]
        public DataCollection $moves,

        public array $types,

        public string $sprite
    ) {
    }
}
