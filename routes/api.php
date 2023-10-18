<?php

use App\Actions\AssignPokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/pokemon',AssignPokemon::class);
