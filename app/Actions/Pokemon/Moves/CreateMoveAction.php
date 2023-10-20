<?php

namespace App\Actions\Pokemon\Moves;

use App\DTO\Pokemon\Moves\MoveDataDTO;
use App\Models\Pokemon;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateMoveAction
{
    use AsAction;

    public function handle(Pokemon $pokemon, MoveDataDTO $moveData): void
    {
        $pokemon->moves()->create($moveData->toArray());
    }
}
