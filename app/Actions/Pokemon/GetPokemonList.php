<?php

namespace App\Actions\Pokemon;

use App\Data\Pokemon\Pokemon;
use App\Data\Pokemon\PokemonCandidateEndpoint;
use Exception;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPokemonList
{
    use AsAction;

    public function handle()
    {
        try {
            return $this->mountPokemons();
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            //Trying a second time

            try {
                return $this->mountPokemons();
            } catch (\Throwable $secondTry) {
                Log::debug($secondTry->getMessage());
                throw $secondTry;
            }
        }
    }

    private function mountPokemons()
    {
        $candidates = $this->getCandidates();

        $selectedPokemons = [];

        foreach ($candidates as $key => $candidate) {
            $info = GetPokemonInfo::run($candidate);
            $selectedPokemons[] = [
                "name" => str_replace("-", " ", $candidate->name),
                "info" => $info
            ];
        }

        return Pokemon::collection($selectedPokemons);
    }


    private function getCandidates()
    {

        $resultData = Cache::remember('all_pokemons', 60 * 60, function () {
            $response =  Http::get(config('app.pokeapi_endpoint') . 'pokemon', [
                'limit' => '2000'
            ]);

            if (!$response->ok()) {
                Log::debug($response->json());
                throw new Exception("Unable to obtain candidates data from api");
            }

            $content = $response->json();

            $validator = Validator::make($content, [
                'results' => 'required|array|min:2',
            ]);

            if ($validator->fails()) {
                Log::debug($validator->getMessageBag());
                throw new Exception("Insufficient api data");
            }

            $content = $validator->validated();

            return collect($content["results"]);
        });

        $candidates = $resultData->random(2);

        if ($candidates->count() !== 2) {
            Log::debug($candidates);
            throw new Exception("Invalid candidates quantity");
        }

        $candidateEndpoints = PokemonCandidateEndpoint::collection($candidates);

        return $candidateEndpoints;
    }
}
