<?php

namespace App\Actions;

use App\Data\PokemonList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPokemonList
{
    use AsAction;

    public function handle()
    {
        $content = $this->getCandidates();
        return $content;
    }

    private function getCandidates()
    {
        $response = Http::get(config('app.pokeapi_endpoint') . 'pokemon', [
            'limit' => '2000'
        ]);

        $completeList = PokemonList::from($response->json());
        $candidates = Arr::random($completeList->results, 2);

        if (!$this->assertCandidates($candidates)) {
            throw new Exception("Invalid candidates");
        }

        return $candidates;
    }

    private function assertCandidates(array $candidates): bool
    {
        if (count($candidates) !== 2) {
            throw new Exception("Invalid candidates quantity");
        }

        foreach ($candidates as $candidate) {
            $validator = Validator::make($candidate, [
                'name' => [
                    "required",
                    "string",
                    "min:2"
                ],
                'url' => [
                    "required",
                    "string",
                    "regex:/https:\/\/pokeapi\.co\/api\/v2\/pokemon\/[0-9]{1,6}\//"
                ],
            ]);

            if ($validator->fails()) {
                throw new Exception("Invalid candidate data structure");
            }
        }

        return true;
    }
}
