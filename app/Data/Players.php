<?php

namespace App\Data;

use App\Data\Pokemon\Pokemon;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;

class Players extends Data
{
    public function __construct(
        public Pokemon $pokemon,
        public bool $human,
    ) {
    }
}
