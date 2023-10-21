<?php

namespace App\Actions\Battle;

use App\Actions\Pokemon\CreatePokemonDTOFromPokemonModelAction;
use App\DTO\BattleStateDTO;
use App\Models\Battle;
use App\Models\Move;
use App\Models\Pokemon;
use App\Models\Type;
use App\Models\TypeDamageMultiplier;
use Lorisleiva\Actions\Concerns\AsAction;

class AttackAction
{
    use AsAction;

    public function handle(int $battleId, int $moveId): BattleStateDTO
    {
        $battle = Battle::with('playerPokemon.moves')
            ->with('npcPokemon.moves')
            ->find($battleId);

        $move = $this->getSelectedMoveInformation($moveId);

        $playerPokemon = $battle->playerPokemon;

        $npcPokemon = $battle->npcPokemon;

        $damageDealtToNPC = $this->calculateMoveDamage(attacker: $playerPokemon, target: $npcPokemon, move: $move);

        $npcPokemon = $this->assignDamageDoneToPokemon($npcPokemon, $damageDealtToNPC);

        if ($npcPokemon->current_hp < 1) {
            return $this->updateBattleState(battleId: $battle->id, playerPokemon: $playerPokemon, npcPokemon: $npcPokemon);
        }

        $damageDealtToPlayer = $this->calculateMoveDamage(attacker: $npcPokemon, target: $playerPokemon, move: $this->getRandomMoveFromPokemon($npcPokemon));

        $playerPokemon = $this->assignDamageDoneToPokemon($playerPokemon, $damageDealtToPlayer);

        return $this->updateBattleState(battleId: $battle->id, playerPokemon: $playerPokemon, npcPokemon: $npcPokemon);
    }

    private function getRandomMoveFromPokemon(Pokemon $pokemon)
    {
        return $pokemon->moves->random();
    }

    private function updateBattleState(int $battleId, Pokemon $playerPokemon, Pokemon $npcPokemon): BattleStateDTO
    {
        $playerPokemon = CreatePokemonDTOFromPokemonModelAction::run($playerPokemon);

        $npcPokemon = CreatePokemonDTOFromPokemonModelAction::run($npcPokemon);

        return new BattleStateDTO(id: $battleId, playerPokemon: $playerPokemon, npcPokemon: $npcPokemon);
    }

    private function assignDamageDoneToPokemon(Pokemon $pokemon, int $damageReceived): Pokemon
    {
        $newHpValue = $pokemon->current_hp - $damageReceived;
        if ($newHpValue < 0) {
            $pokemon->current_hp = 0;
        } else {
            $pokemon->current_hp = $newHpValue;
        }
        $pokemon->update();

        return $pokemon;
    }

    private function getSelectedMoveInformation(int $moveId): Move
    {
        return Move::whereId($moveId)->first();
    }

    private function calculateMoveDamage(Pokemon $attacker, Pokemon $target, Move $move): int
    {
        $pokemonDefaultLevel = 100;

        $randomizedDamageVariance = $this->getRandomizedDamageVariance();

        $stabMultiplier = 1;
        if ($this->checkIfMoveIsSameTypeAsPokemon(pokemonTypes: $attacker->types, move: $move) === true) {
            $stabMultiplier = 1.5;
        }

        $criticalMultiplier = 1;
        if ($this->calculateIfAttackIsCritical(pokemonSpeed: $attacker->speed) === true) {
            $criticalMultiplier = 2;
        }

        $levelDamageFactor = $this->getLevelDamageFactor(
            level: $pokemonDefaultLevel,
            criticalMultiplier: $criticalMultiplier
        );

        $attackVersusDefenseFactor = $this->getAttackVersusDefenseFactor(
            attacker: $attacker,
            target: $target,
            move: $move
        );

        $moveTypeDamageAgainstTargetMultiplier = $this->getMoveAndTargetTypeDamageMultiplier(
            move: $move,
            target: $target
        );

        $movePowerDamageFactor = $this->calculateTotalMovePower(
            levelDamageFactor: $levelDamageFactor,
            movePower: (int) $move->power,
            attackVersusDefenseFactor: $attackVersusDefenseFactor
        );

        $totalDamageDone = $movePowerDamageFactor * $stabMultiplier * $moveTypeDamageAgainstTargetMultiplier * $randomizedDamageVariance;

        return ceil($totalDamageDone);
    }

    private function calculateTotalMovePower(float $levelDamageFactor, int $movePower, float $attackVersusDefenseFactor)
    {
        return (($levelDamageFactor * $movePower * $attackVersusDefenseFactor) / 50) + 2;
    }

    private function getMoveAndTargetTypeDamageMultiplier(Move $move, Pokemon $target): float
    {
        $damageMultiplier = 1;

        $moveMultipliers = TypeDamageMultiplier::whereActorType($move->type)->get();

        foreach ($target->types as $targetType) {

            $relatedMultiplier = $moveMultipliers->firstWhere('target_type', $targetType);

            $damageMultiplier *= $relatedMultiplier->multiplier;
        }

        return $damageMultiplier;
    }

    private function getAttackVersusDefenseFactor(Pokemon $attacker, Pokemon $target, Move $move): float
    {
        $attackPower = $attacker->attack;

        $defensePower = $target->defense;

        $type = Type::whereName($move->type)->firstOrFail();

        if ($type->is_physical !== true) {
            $attackPower = $attacker->special_attack;

            $defensePower = $target->special_defense;
        }

        if ($this->checkIfAttackOrDefenseIsAboveThreshold(attackPower: $attackPower, defensePower: $defensePower) == true) {
            $attackPower = $attackPower / 4;
            $defensePower = $defensePower / 4;
        }

        return $attackPower / $defensePower;
    }

    private function checkIfAttackOrDefenseIsAboveThreshold(int $attackPower, int $defensePower): bool
    {
        return $attackPower > 255 || $defensePower > 255;
    }

    private function getLevelDamageFactor(int $level, int $criticalMultiplier): float
    {
        return ((2 * $level * $criticalMultiplier) / 5) + 2;
    }

    private function getRandomizedDamageVariance(): float
    {
        return rand(217, 255) / 255;
    }

    private function checkIfMoveIsSameTypeAsPokemon(array $pokemonTypes, Move $move): bool
    {
        return collect($pokemonTypes)->contains($move->type);
    }

    private function calculateIfAttackIsCritical(int $pokemonSpeed): bool
    {
        $randomizedThreshold = rand(0, 255);
        $speedThreshold = ceil($pokemonSpeed / 2);

        return $randomizedThreshold < $speedThreshold;
    }
}
