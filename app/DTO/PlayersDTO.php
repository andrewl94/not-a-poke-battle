<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class PlayersDTO extends Data
{
    public function __construct(
        public PlayerDTO $player,
        public PlayerDTO $npc,
    ) {
    }
}
