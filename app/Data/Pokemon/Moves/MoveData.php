<?php

namespace App\Data\Pokemon\Moves;

use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;

class MoveData extends Data
{
    public function __construct(
        public string $name,
        public ?int $power,
        public ?int $pp,
        public ?string $type,
    ) {
    }
}
