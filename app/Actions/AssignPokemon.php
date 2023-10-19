<?php

namespace App\Actions;

use Illuminate\Http\Request;

use Lorisleiva\Actions\Concerns\AsAction;

class AssignPokemon
{
    use AsAction;

    public function handle()
    {
        $candidates = GetPokemonList::run();
        return $candidates;
    }

    public function asController(Request $request)
    {
        $candidate = $this->handle();
        return response()->json($candidate);
    }
}
