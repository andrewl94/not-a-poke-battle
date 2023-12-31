<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PokeApiService
{
    public function __construct(readonly protected string $baseUrl = 'https://pokeapi.co/api/v2')
    {
    }

    public function getAllPokemons()
    {
        $limit = 2000;

        $response = Http::get($this->baseUrl.'/pokemon', [
            'limit' => $limit,
        ])
            ->throw();

        return $response->json();
    }

    public function getPokemonInformation(string $pokemonInformationUrl)
    {
        $response = Http::get($pokemonInformationUrl)->throw();

        return $response->json();
    }

    public function getMoveInformation(string $moveInformationUrl)
    {
        $response = Http::get($moveInformationUrl)->throw();

        return $response->json();
    }
}
