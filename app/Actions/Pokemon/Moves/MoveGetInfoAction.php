<?php

namespace App\Actions\Pokemon\Moves;

use App\DTO\Pokemon\Moves\MoveDataDTO;
use App\DTO\Pokemon\Moves\MoveEndpointDTO;

use App\Services\PokeApi;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use Lorisleiva\Actions\Concerns\AsAction;

class MoveGetInfoAction
{
    use AsAction;

    public function __construct(protected PokeApi $pokeApi)
    {
    }

    public function handle(MoveEndpointDTO $move)
    {
        return $this->getInformation($move);
    }

    private function getInformation(MoveEndpointDTO $move): MoveDataDTO
    {
        $oneHourInSeconds = 60 * 60;

        $moveData = Cache::remember($move->url, $oneHourInSeconds, function () use ($move) {
            $content =  $this->pokeApi->getMoveInformation($move->url);

            return collect($content);
        });

        $moveData = MoveDataDTO::validateAndCreate(
            [
                "name" => $this->formatMoveName($moveData->get("name")),
                "power" => $moveData->get("power"),
                "pp" => $moveData->get("pp"),
                "type" => $this->getMoveType($moveData->get("type")),
            ]

        );

        return $moveData;
    }

    private function formatMoveName(string $moveName): string
    {
        return Str::of($moveName)->headline();
    }

    private function getMoveType(array $type): string
    {
        return $type["name"];
    }
}
