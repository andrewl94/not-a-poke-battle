<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\LaravelData\Attributes\Validation;
use Illuminate\Validation\Rule as ValidationRule;

class Pokemon extends Data
{
    public function __construct(
        public string $name,
        #[Regex('/^https:\/\/pokeapi\.co\/api\/v2\/pokemon\/[0-9]{1,6}\//')]
        public string $url,
    ) {
    }




}
