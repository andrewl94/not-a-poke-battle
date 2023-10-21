<?php

namespace App\Actions\Pokemon\Moves;

use App\DTO\Pokemon\Moves\MoveDataDTO;
use App\DTO\Pokemon\Moves\MoveEndpointDTO;
use App\Services\PokeApiService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class MoveGetInfoAction
{
    use AsAction;

    public function __construct(protected PokeApiService $pokeApiService)
    {
    }

    public function handle(MoveEndpointDTO $move)
    {
        return $this->getMoveInformation($move);
    }

    private function getMoveInformation(MoveEndpointDTO $move): MoveDataDTO
    {
        $oneHourInSeconds = 60 * 60;

        $moveData = Cache::remember($move->url, $oneHourInSeconds, function () use ($move) {
            $content = $this->pokeApiService->getMoveInformation($move->url);

            return collect($content);
        });

        $moveData = MoveDataDTO::validateAndCreate(
            [
                'id' => $this->getMoveIdFromUrl($move->url),
                'name' => $this->formatMoveName($moveData->get('name')),
                'power' => $moveData->get('power'),
                'pp' => $moveData->get('pp'),
                'type' => $this->getMoveType($moveData->get('type')),
            ]
        );

        return $moveData;
    }

    private function getMoveIdFromUrl(string $url): int
    {
        return (int) (Str::of($url)->between('https://pokeapi.co/api/v2/move/', '/')->__toString());
    }

    private function formatMoveName(string $moveName): string
    {
        return Str::of($moveName)->headline();
    }

    private function getMoveType(array $type): string
    {
        return $type['name'];
    }
}
