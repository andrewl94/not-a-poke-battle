<?php

use App\Actions\AssignPlayersAction;
use Illuminate\Support\Facades\Route;

Route::get('/battle',AssignPlayersAction::class);
