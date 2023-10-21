<?php

use App\Actions\StartBattleAction;
use Illuminate\Support\Facades\Route;

Route::get('/battle',StartBattleAction::class);
