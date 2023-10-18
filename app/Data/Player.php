<?php
namespace App\Data;

use Spatie\LaravelData\Data;

class Player extends Data
{
    public function __construct(
        public bool $human_controlled,
        public string $pokemon,
    ) {
    }
}
