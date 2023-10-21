<?php

namespace App\Enums;

enum PokemonStatEnum: string
{
    case HP = 'hp';
    case ATTACK = 'attack';
    case DEFENSE = 'defense';
    case SPECIAL_ATTACK = 'special_attack';
    case SPECIAL_DEFENSE = 'special_defense';
    case SPEED = 'speed';
}
