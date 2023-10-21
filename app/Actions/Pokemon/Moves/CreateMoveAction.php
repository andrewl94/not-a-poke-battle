<?php

namespace App\Actions\Pokemon\Moves;

use App\DTO\Pokemon\Moves\MoveDataDTO;
use App\Models\Move;
use App\Models\Pokemon;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateMoveAction
{
    use AsAction;

    public function handle(MoveDataDTO $moveData): Move
    {
        return Move::firstOrCreate($moveData->toArray());
    }
}
