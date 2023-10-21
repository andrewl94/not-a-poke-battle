<?php

namespace Database\Seeders;

use App\Enums\TypeEnum;
use App\Models\TypeDamageMultiplier;
use Illuminate\Database\Seeder;

class TypesDamageMultiplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    const MULTIPLIER = [
        TypeEnum::NORMAL->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 1,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 1,
            TypeEnum::ICE->value => 1,
            TypeEnum::FIGHTING->value => 2,
            TypeEnum::POISON->value => 1,
            TypeEnum::GROUND->value => 1,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 0.5,
            TypeEnum::GHOST->value => 0,
            TypeEnum::DRAGON->value => 1,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 1,
        ],
        TypeEnum::FIRE->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 0.5,
            TypeEnum::WATER->value => 0.5,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 2,
            TypeEnum::ICE->value => 0.5,
            TypeEnum::FIGHTING->value => 1,
            TypeEnum::POISON->value => 1,
            TypeEnum::GROUND->value => 1,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 2,
            TypeEnum::ROCK->value => 0.5,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 0.5,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 2,
            TypeEnum::FAIRY->value => 1,
        ],
        TypeEnum::WATER->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 2,
            TypeEnum::WATER->value => 0.5,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 0.5,
            TypeEnum::ICE->value => 0.5,
            TypeEnum::FIGHTING->value => 1,
            TypeEnum::POISON->value => 1,
            TypeEnum::GROUND->value => 2,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 2,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 0.5,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 1,
            TypeEnum::FAIRY->value => 0.5,
        ],
        TypeEnum::ELECTRIC->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 1,
            TypeEnum::WATER->value => 2,
            TypeEnum::ELECTRIC->value => 0.5,
            TypeEnum::GRASS->value => 0.5,
            TypeEnum::ICE->value => 1,
            TypeEnum::FIGHTING->value => 1,
            TypeEnum::POISON->value => 1,
            TypeEnum::GROUND->value => 0,
            TypeEnum::FLYING->value => 2,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 1,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 0.5,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 1,
        ],
        TypeEnum::GRASS->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 0.5,
            TypeEnum::WATER->value => 2,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 0.5,
            TypeEnum::ICE->value => 2,
            TypeEnum::FIGHTING->value => 1,
            TypeEnum::POISON->value => 0.5,
            TypeEnum::GROUND->value => 2,
            TypeEnum::FLYING->value => 0.5,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 0.5,
            TypeEnum::ROCK->value => 2,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 0.5,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 1,
        ],
        TypeEnum::ICE->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 0.5,
            TypeEnum::WATER->value => 0.5,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 2,
            TypeEnum::ICE->value => 0.5,
            TypeEnum::FIGHTING->value => 1,
            TypeEnum::POISON->value => 1,
            TypeEnum::GROUND->value => 2,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 2,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 2,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 2,
            TypeEnum::FAIRY->value => 1,
        ],
        TypeEnum::FIGHTING->value => [
            TypeEnum::NORMAL->value => 2,
            TypeEnum::FIRE->value => 1,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 1,
            TypeEnum::ICE->value => 2,
            TypeEnum::FIGHTING->value => 1,
            TypeEnum::POISON->value => 0.5,
            TypeEnum::GROUND->value => 1,
            TypeEnum::FLYING->value => 0.5,
            TypeEnum::PSYCHIC->value => 0.5,
            TypeEnum::BUG->value => 0.5,
            TypeEnum::ROCK->value => 2,
            TypeEnum::GHOST->value => 0,
            TypeEnum::DRAGON->value => 1,
            TypeEnum::DARK->value => 2,
            TypeEnum::STEEL->value => 2,
            TypeEnum::FAIRY->value => 0.5,
        ],
        TypeEnum::POISON->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 1,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 0.5,
            TypeEnum::ICE->value => 1,
            TypeEnum::FIGHTING->value => 1,
            TypeEnum::POISON->value => 0.5,
            TypeEnum::GROUND->value => 2,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 2,
            TypeEnum::BUG->value => 0.5,
            TypeEnum::ROCK->value => 1,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 1,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 0,
            TypeEnum::FAIRY->value => 2,
        ],
        TypeEnum::GROUND->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 2,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 2,
            TypeEnum::GRASS->value => 0.5,
            TypeEnum::ICE->value => 1,
            TypeEnum::FIGHTING->value => 1,
            TypeEnum::POISON->value => 0.5,
            TypeEnum::GROUND->value => 1,
            TypeEnum::FLYING->value => 0,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 0.5,
            TypeEnum::ROCK->value => 2,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 1,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 2,
            TypeEnum::FAIRY->value => 1,
        ],
        TypeEnum::FLYING->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 1,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 0.5,
            TypeEnum::GRASS->value => 2,
            TypeEnum::ICE->value => 2,
            TypeEnum::FIGHTING->value => 2,
            TypeEnum::POISON->value => 1,
            TypeEnum::GROUND->value => 1,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 0.5,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 1,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 1,
        ],
        TypeEnum::PSYCHIC->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 1,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 1,
            TypeEnum::ICE->value => 1,
            TypeEnum::FIGHTING->value => 0.5,
            TypeEnum::POISON->value => 2,
            TypeEnum::GROUND->value => 1,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 0.5,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 1,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 1,
            TypeEnum::DARK->value => 2,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 1,
        ],
        TypeEnum::BUG->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 2,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 2,
            TypeEnum::ICE->value => 1,
            TypeEnum::FIGHTING->value => 0.5,
            TypeEnum::POISON->value => 0.5,
            TypeEnum::GROUND->value => 1,
            TypeEnum::FLYING->value => 2,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 1,
            TypeEnum::GHOST->value => 0.5,
            TypeEnum::DRAGON->value => 1,
            TypeEnum::DARK->value => 2,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 0.5,
        ],
        TypeEnum::ROCK->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 2,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 1,
            TypeEnum::ICE->value => 2,
            TypeEnum::FIGHTING->value => 2,
            TypeEnum::POISON->value => 1,
            TypeEnum::GROUND->value => 0.5,
            TypeEnum::FLYING->value => 2,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 1,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 1,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 1,
        ],
        TypeEnum::GHOST->value => [
            TypeEnum::NORMAL->value => 0,
            TypeEnum::FIRE->value => 1,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 1,
            TypeEnum::ICE->value => 1,
            TypeEnum::FIGHTING->value => 0,
            TypeEnum::POISON->value => 0.5,
            TypeEnum::GROUND->value => 1,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 1,
            TypeEnum::GHOST->value => 2,
            TypeEnum::DRAGON->value => 1,
            TypeEnum::DARK->value => 2,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 1,
        ],
        TypeEnum::DRAGON->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 1,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 1,
            TypeEnum::ICE->value => 1,
            TypeEnum::FIGHTING->value => 1,
            TypeEnum::POISON->value => 1,
            TypeEnum::GROUND->value => 1,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 0.5,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 1,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 2,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 0,
        ],
        TypeEnum::DARK->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 1,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 1,
            TypeEnum::ICE->value => 1,
            TypeEnum::FIGHTING->value => 2,
            TypeEnum::POISON->value => 2,
            TypeEnum::GROUND->value => 1,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 0.5,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 1,
            TypeEnum::GHOST->value => 0.5,
            TypeEnum::DRAGON->value => 1,
            TypeEnum::DARK->value => 0.5,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 0.5,
        ],
        TypeEnum::STEEL->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 0.5,
            TypeEnum::WATER->value => 0.5,
            TypeEnum::ELECTRIC->value => 0.5,
            TypeEnum::GRASS->value => 1,
            TypeEnum::ICE->value => 2,
            TypeEnum::FIGHTING->value => 2,
            TypeEnum::POISON->value => 0,
            TypeEnum::GROUND->value => 2,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 0.5,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 0.5,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 1,
            TypeEnum::DARK->value => 1,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 2,
        ],
        TypeEnum::FAIRY->value => [
            TypeEnum::NORMAL->value => 1,
            TypeEnum::FIRE->value => 0.5,
            TypeEnum::WATER->value => 1,
            TypeEnum::ELECTRIC->value => 1,
            TypeEnum::GRASS->value => 1,
            TypeEnum::ICE->value => 1,
            TypeEnum::FIGHTING->value => 2,
            TypeEnum::POISON->value => 0.5,
            TypeEnum::GROUND->value => 1,
            TypeEnum::FLYING->value => 1,
            TypeEnum::PSYCHIC->value => 1,
            TypeEnum::BUG->value => 1,
            TypeEnum::ROCK->value => 1,
            TypeEnum::GHOST->value => 1,
            TypeEnum::DRAGON->value => 2,
            TypeEnum::DARK->value => 2,
            TypeEnum::STEEL->value => 0.5,
            TypeEnum::FAIRY->value => 1,
        ],
    ];

    public function run(): void
    {
        foreach (self::MULTIPLIER as $actor => $targets) {
            foreach ($targets as $target => $multiplier) {
                TypeDamageMultiplier::insert([
                    'actor_type' => $actor,
                    'target_type' => $target,
                    'multiplier' => $multiplier,
                ]);
            }
        }
    }
}