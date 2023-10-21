<?php

namespace App\Livewire;

use App\Actions\StartBattleAction;
use App\Actions\Battle\AttackAction;
use App\DTO\BattleStateDTO;
use Livewire\Component;

class BattleSceneComponent extends Component
{
    public ?bool $gameState = null;

    public ?int $selectedMoveId = null;

    public array $battleLog = [];

    public array $playerPokemon;

    public array $npcPokemon;

    public int $battleId;

    public function render()
    {
        return view('livewire.battle-scene');
    }

    public function mount()
    {
        $battle = StartBattleAction::run();
        $this->loadBattleState($battle);
    }

    public function loadBattleState(BattleStateDTO $battle)
    {
        $this->battleId = $battle->id;

        $this->playerPokemon = $battle->playerPokemon->toArray();

        $this->npcPokemon = $battle->npcPokemon->toArray();
    }

    public function reload()
    {
        return redirect("/");
    }

    public function attack()
    {
        if (!$this->selectedMoveId) {
            return;
        }
        $battle = AttackAction::run(battleId: $this->battleId, moveId: $this->selectedMoveId);
        $this->loadBattleState($battle);
    }
}
