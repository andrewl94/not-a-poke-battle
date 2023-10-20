<?php

namespace App\Actions\Pokemon;

use App\Actions\Pokemon\Moves\MoveGetInfoAction;

use App\DTO\Pokemon\Moves\MoveDataDTO;
use App\DTO\Pokemon\Moves\MoveEndpointDTO;
use App\DTO\Pokemon\PokemonCandidateEndpointDTO;
use App\DTO\Pokemon\PokemonInfoDTO;
use App\DTO\Pokemon\PokemonStatusDTO;

use App\Enums\PokemonStatEnum;

use App\Services\PokeApi;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

use Lorisleiva\Actions\Concerns\AsAction;

use Spatie\LaravelData\DataCollection;

class GetPokemonInformationAction
{
    use AsAction;

    public function __construct(protected PokeApi $pokeApi)
    {
    }

    public function handle(PokemonCandidateEndpointDTO $pokemonCandidateEndpoint): PokemonInfoDTO
    {
        return $this->getPokemonInformation($pokemonCandidateEndpoint);
    }

    private function getPokemonInformation(PokemonCandidateEndpointDTO $pokemonCandidateEndpoint): PokemonInfoDTO
    {
        $oneHourInSeconds = 60 * 60;

        $pokemonInformation = Cache::remember($pokemonCandidateEndpoint->url, $oneHourInSeconds, function () use ($pokemonCandidateEndpoint) {
            $content = $this->pokeApi->getPokemonInformation($pokemonCandidateEndpoint->url);
            return collect($content);
        });

        $moves = $this->selectMoves($pokemonInformation->get("moves"));

        $types = $this->getPokemonTypes($pokemonInformation->get("types"));

        $stats = $this->getPokemonStats($pokemonInformation->get("stats"));

        $sprite = $this->getPokemonSprite($pokemonInformation->get("sprites"));

        $pokemonInformation = PokemonInfoDTO::validateAndCreate([
            "stats" => $stats->toArray(),
            "types" => $types->toArray(),
            "moves" => $moves->toArray(),
            "sprite" => $sprite
        ]);

        return $pokemonInformation;
    }


    private function getPokemonStats(array $pokemonStats): PokemonStatusDTO
    {
        $allStatsFromPokemon = collect($pokemonStats);

        $statsData = $allStatsFromPokemon->flatMap(function ($stats) {
            return $this->calculateLevel100Stats(statType: $this->formatStatName($stats["stat"]["name"]), statBase: $stats["base_stat"]);
        });

        return PokemonStatusDTO::validateAndCreate($statsData);
    }

    private function formatStatName(string $statName): string
    {
        return Str::of($statName)->camel();
    }

    private function calculateLevel100Stats(string $statType, int $statBase = 0): array
    {
        $individualValue = rand(1, 9);

        $effortValue = rand(15000, 21000);

        $level = 100;

        if ($statType === PokemonStatEnum::HP->value) {

            $finalStat = $this->calculateLeveledUpHealthPoints(
                statBase: $statBase,
                individualValue: $individualValue,
                effortValue: $effortValue,
                level: $level
            );

        } else {

            $finalStat = $this->calculateLeveledUpStandardStatus(
                statBase: $statBase,
                individualValue: $individualValue,
                effortValue: $effortValue,
                level: $level
            );

        }
        return [
            $statType => $finalStat
        ];
    }

    private function calculateLeveledUpHealthPoints(int $statBase, int $individualValue, int $effortValue, int $level): int
    {
        return ceil(((($statBase + $individualValue) * 2  + (sqrt($effortValue) / 4) * $level) / 100) + $level + 10);
    }

    private function calculateLeveledUpStandardStatus(int $statBase, int $individualValue, int $effortValue, int $level): int
    {
        return ceil(((($statBase + $individualValue) * 2  + (sqrt($effortValue) / 4) * $level) / 100) + 5);
    }

    private function selectMoves(array $pokemonMoves): DataCollection
    {
        $movesCandidates = collect($pokemonMoves)->pluck("move");

        $selectedMoves = $movesCandidates->random(3);

        $moveEndpoints = MoveEndpointDTO::collection($selectedMoves);

        $moveDatas = [];

        foreach ($moveEndpoints as $key => $moveEndpoint) {
            $moveDatas[] = MoveGetInfoAction::run($moveEndpoint);
        }

        /** @var DataCollection $moves */
        $moves = MoveDataDTO::collection($moveDatas);

        return $moves;
    }

    private function getPokemonTypes(array $pokemonTypes): Collection
    {
        $typesData = collect($pokemonTypes);

        $types = $typesData->flatMap(function ($type) {
            return [
                $type["type"]["name"],
            ];
        });

        return $types;
    }

    private function getPokemonSprite(array $pokemonSprites) : string
    {
        $sprites = collect($pokemonSprites);

        return $sprites->get("front_default");
    }
}
