<?php

namespace App\Actions\Pokemon;

use Exception;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\DTO\Pokemon\PokemonDTO;
use App\DTO\Pokemon\PokemonCandidateEndpointDTO;

use App\Services\PokeApi;

use Lorisleiva\Actions\Concerns\AsAction;

use Spatie\LaravelData\DataCollection;

class GetPokemonsForBattleAction
{
    use AsAction;

    public function __construct(protected PokeApi $pokeApi)
    {
    }

    public function handle(): DataCollection
    {
        return $this->getPokemonsForBattle();
    }

    private function getPokemonsForBattle(): DataCollection
    {
        $pokemonsCandidatesForBattle = $this->getPokemonsCandidatesForBattle();

        $selectedPokemons = [];

        foreach ($pokemonsCandidatesForBattle as $pokemonCandidate) {
            $pokemonInfo = GetPokemonInformationAction::run($pokemonCandidate);

            $selectedPokemons[] = [
                "name" => $this->formatPokemonName($pokemonCandidate->name),
                "info" => $pokemonInfo
            ];
        }

        /** @var DataCollection $pokemonsForBattle */
        $pokemonsForBattle = PokemonDTO::collection($selectedPokemons);

        return $pokemonsForBattle;
    }

    private function formatPokemonName(string $pokemonName): string
    {
        return Str::of($pokemonName)->headline();
    }

    private function getPokemonsCandidatesForBattle(): DataCollection
    {
        $oneHourInSeconds = 60 * 60;

        $listOfAllPokemons = Cache::remember('list_of_all_pokemons', $oneHourInSeconds, function () {

            $response =  $this->pokeApi->getAllPokemons();

            $validator = Validator::make($response, [
                'results' => 'required|array|min:2',
            ]);

            if ($validator->fails()) {
                Log::debug($validator->getMessageBag());
                throw new Exception("Insufficient api data");
            }

            $content = $validator->validated();

            return collect($content["results"]);
        });

        $pokemonCandidates = $listOfAllPokemons->random(2);

        /** @var DataCollection $pokemonEndpoints */
        $pokemonEndpoints = PokemonCandidateEndpointDTO::collection($pokemonCandidates);

        return $pokemonEndpoints;
    }
}
