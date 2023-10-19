<?php

namespace App\Actions;

use App\Actions\Pokemon\Moves\MoveGetInfo;
use App\Data\Pokemon\Moves\MoveData;
use App\Data\Pokemon\Moves\MoveEndpoint;
use App\Data\Pokemon\PokemonCandidateEndpoint;
use App\Data\Pokemon\PokemonStatus;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPokemonInfo
{
    use AsAction;

    public function handle(PokemonCandidateEndpoint $pokemon)
    {
        return $this->getInformation($pokemon);
    }

    private function getInformation(PokemonCandidateEndpoint $pokemon)
    {
        $resultData = Cache::remember($pokemon->url, 60, function () use ($pokemon) {
            $response =  Http::get($pokemon->url);
            if (!$response->ok()) {
                throw new Exception("Unable to obtain candidates data from api");
            }
            $content = $response->json();
            return collect($content);
        });

        $moves = $this->getMoves($resultData);

        $types = $this->getTypes($resultData);

        $stats = $this->getStats($resultData);

        $infos = [
            "stats" => $stats,
            "types" => $types,
            "moves" => $moves,
        ];

        return $infos;
    }


    private function getStats($resultData)
    {
        $allStatus = collect($resultData->get("stats"));
        $statusData = $allStatus->flatMap(function ($status) {
            return $this->calculateLevel100Status(str_replace("-", "", $status["stat"]["name"]), $status["base_stat"]);
        });
        try {
            $status = PokemonStatus::validateAndCreate($statusData);
            return $status;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            throw new Exception("Invalid pokemon status data");
        }
    }

    private function calculateLevel100Status(string $statType, int $statBase = 0)
    {
        $iv = rand(1, 9);
        $ev = rand(15000, 21000);
        $level = 100;

        try {
            if ($statType === "hp") {
                $finalStat = ((($statBase + $iv) * 2  + (sqrt($ev) / 4) * $level) / 100) + $level + 10;
            } else {
                $finalStat = ((($statBase + $iv) * 2  + (sqrt($ev) / 4) * $level) / 100) + 5;
            }
            return [
                $statType => $finalStat
            ];
        } catch (\Throwable $th) {
            throw new Exception("Invalid status calculation");
        }
    }

    private function getMoves($resultData)
    {
        $allMoves = collect($resultData->get('moves'))->pluck("move");
        $selectedMoves = $allMoves->random(3);
        $moveEndpoints = MoveEndpoint::collection($selectedMoves);

        $moveDatas = [];
        foreach ($moveEndpoints as $key => $moveEndpoint) {
            $moveDatas[] = MoveGetInfo::run($moveEndpoint);
        }

        $moves = MoveData::collection($moveDatas);
        return $moves;
    }

    private function getTypes($resultData)
    {
        $allTypes = collect($resultData->get("types"));
        $typesData = $allTypes->flatMap(function ($type) {
            return [
                $type["type"]["name"],
            ];
        });

        return $typesData;
    }
}
