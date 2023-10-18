<?php

namespace App\Actions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
