<?php

namespace App\DTO\Pokemon\Moves;

use Spatie\LaravelData\Data;

class MoveDataDTO extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public ?int $power,
        public ?int $pp,
        public ?string $type,
    ) {
    }
}
