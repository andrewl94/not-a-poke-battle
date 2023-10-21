<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    const TYPES = [
        ['name' => 'normal', 'is_physical' => false],
        ['name' => 'fire', 'is_physical' => false],
        ['name' => 'water', 'is_physical' => false],
        ['name' => 'electric', 'is_physical' => false],
        ['name' => 'grass', 'is_physical' => false],
        ['name' => 'ice', 'is_physical' => false],
        ['name' => 'fighting', 'is_physical' => false],
        ['name' => 'poison', 'is_physical' => false],
        ['name' => 'ground', 'is_physical' => false],
        ['name' => 'flying', 'is_physical' => false],
        ['name' => 'psychic', 'is_physical' => false],
        ['name' => 'bug', 'is_physical' => false],
        ['name' => 'rock', 'is_physical' => false],
        ['name' => 'ghost', 'is_physical' => false],
        ['name' => 'steel', 'is_physical' => false],
        ['name' => 'dark', 'is_physical' => false],
        ['name' => 'dragon', 'is_physical' => false],
        ['name' => 'fairy', 'is_physical' => false],
    ];

    public function run(): void
    {
        Type::insert(self::TYPES);
    }
}
