<?php

namespace App\Actions\Pokemon\Moves;

use App\Data\Pokemon\Moves\MoveData;
use App\Data\Pokemon\Moves\MoveEndpoint;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Lorisleiva\Actions\Concerns\AsAction;

class MoveGetInfo
{
    use AsAction;

    public function handle(MoveEndpoint $move)
    {
        return $this->getInformation($move);
    }

    private function getInformation(MoveEndpoint $move): MoveData
    {
        $resultData = Cache::remember($move->url, 10, function () use ($move) {
            $response =  Http::get($move->url);
            if (!$response->ok()) {
                Log::debug($response->json());
                throw new Exception("Unable to obtain data from api");
            }
            $content = $response->json();
            return collect($content);
        });

        try {
            $moveData = MoveData::validateAndCreate(
                [
                    "name" => str_replace("-", " ", $resultData->get("name")),
                    "power" => $resultData->get("power"),
                    "pp" => $resultData->get("pp"),
                    "type" => $resultData->get("type")["name"],
                ]

            );
            return $moveData;
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            throw new Exception("Invalid move data");
        }
    }
}
