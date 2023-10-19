<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;

class PokemonInfo extends Data
{
    public function __construct(
        #[DataCollectionOf(Move::class)]
        public DataCollection $moves,
    ) {
    }




}
