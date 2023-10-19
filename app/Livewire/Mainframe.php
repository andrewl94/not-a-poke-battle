<?php

namespace App\Livewire;

use App\Data\Players;
use App\Enums\TypesDynamics;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Mainframe extends Component
{

    public $player;

    public $npc;

    public $gameState = null;

    public $gameLoaded = null;

    public $selectedMove = null;

    public $playerHealth = [
        "current" => 0,
        "max" => 0,
        "ratio" => 100
    ];

    public $npcHealth = [
        "current" => 0,
        "max" => 0,
        "ratio" => 100
    ];

    public $battleLog = [];

    public function render()
    {
        return view('livewire.mainframe');
    }

    public function mount()
    {
        $response = Http::get(url("/api/battle"));

        if (!$response->ok()) {
            Log::debug($response->json());
            $this->gameLoaded = false;
            return;
        }
        try {
            $players = Players::collection($response->json());
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

        $players->map(fn ($player) => $player->human === true ? $this->player = json_decode($player->toJson()) : $this->npc = json_decode($player->toJson()));

        $this->playerHealth["current"] = $this->player->pokemon->info->stats->hp;
        $this->playerHealth["max"] =  $this->playerHealth["current"];
        $this->playerHealth["ratio"] = 100;

        $this->npcHealth["current"] = $this->npc->pokemon->info->stats->hp;
        $this->npcHealth["max"] =  $this->npcHealth["current"];
        $this->npcHealth["ratio"] = 100;

        $this->gameLoaded = true;
    }

    public function reload()
    {
        return redirect("/");
    }

    public function attack()
    {
        if (!$this->selectedMove || $this->gameState !== null) {
            return;
        }

        $playAttack = $this->damage($this->player->pokemon, $this->selectedMove, $this->npc->pokemon);
        $this->npcHealth["current"] = ceil($this->npcHealth["current"] - $playAttack);
        $this->npcHealth["ratio"] = ceil(($this->npcHealth["current"] /  $this->npcHealth["max"] * 100) / 10) * 10;

        $this->logBattle($this->selectedMove, $playAttack, $this->player->pokemon->name);

        if ($this->npcHealth["current"] <= 0) {
            $this->npcHealth["current"] = 0;
            $this->npcHealth["ratio"] = 0;
            $this->gameState = true;
            return;
        }

        $npcMove = collect($this->npc->pokemon->info->moves)->random();
        $npcAttack = $this->damage($this->npc->pokemon, $npcMove->name, $this->player->pokemon);
        $this->playerHealth["current"] = ceil($this->playerHealth["current"] - $npcAttack);
        $this->playerHealth["ratio"] = ceil(($this->playerHealth["current"] /  $this->playerHealth["max"] * 100) / 10) * 10;

        $this->logBattle($npcMove->name, $npcAttack, $this->npc->pokemon->name);

        if ($this->playerHealth["current"] <= 0) {
            $this->playerHealth["current"] = 0;
            $this->playerHealth["ratio"] = 0;
            $this->gameState = false;
        }
    }

    private function logBattle(string $move, int $damage, string $pokemonName)
    {
        $this->battleLog[] = [
            "move" => $move,
            "damage" => $damage,
            "pokemonName" => $pokemonName
        ];
    }

    private function damage($attacker, string $selectedMove, $target)
    {
        $move = collect($attacker->info->moves)->first(function ($mv) use ($selectedMove) {
            return  $mv->name === $selectedMove;
        });

        $stab = collect($attacker->info->types)->first(function ($type) use ($move) {
            return  $type === $move->type;
        }) ? 1.5 : 1;

        $critical = $this->getCriticalFactor($attacker->info->stats->speed);
        $random = rand(217, 255) / 255;
        $level = 100;

        $levelFactor = ((2 * $level * $critical) / 5) + 2;
        $adFactor = $this->getAdFactor($move, $attacker->info->stats, $target->info->stats);
        $moveFactor = (($levelFactor * $move->power * $adFactor) / 50) + 2;

        $typeFactor = $this->getTypeFactor($attacker->info->types, $target->info->types);

        $finalDamage = $moveFactor * $stab * $typeFactor * $random;
        return $finalDamage;
    }

    private function getCriticalFactor($speed)
    {
        $random = rand(0, 255);
        return $random < ($speed / 2) ? 2 : 1;
    }

    private function getAdFactor($move, $attackerStats, $targetStats)
    {
        $a = 0;
        $d = 0;
        switch ($move->type) {
            case "normal":
            case "fighting":
            case "flying":
            case "ground":
            case "rock":
            case "bug":
            case "ghost":
            case "poison":
            case "steel":
                $a = $attackerStats->attack;
                $d = $targetStats->defense;
                break;
            default:
                $a = $attackerStats->specialattack;
                $d = $targetStats->specialdefense;
                break;
        }

        if ($a > 255 || $d > 255) {
            $a = floor($a / 4);
            $d = floor($d / 4);
        }

        return $a / $d;
    }

    private function getTypeFactor($attackerTypes, $targetTypes)
    {
        $factors = [];
        foreach ($attackerTypes as $atype) {
            $typeFactor = 0;
            $dinamic = TypesDynamics::TYPES[$atype];
            foreach ($targetTypes as $ttype) {
                $typeFactor += $dinamic[$ttype];
            }
            $factors[] = $typeFactor;
        }

        return  array_reduce($factors, function ($a, $b) {
            return $a * $b;
        }, 1);
    }
}
