<?php

use App\Actions\AssignPlayers;
use Illuminate\Support\Facades\Route;

Route::get('/battle',AssignPlayers::class);
