<?php

namespace App\Livewire;

use App\Actions\Battle\AttackAction;
use App\Actions\StartBattleAction;
use App\DTO\BattleStateDTO;
use Livewire\Component;

class BattleSceneComponent extends Component
{
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
        return retry(5, function () {
            $battle = StartBattleAction::run();
            $this->loadBattleState($battle);
        },500);

    }

    public function loadBattleState(BattleStateDTO $battle)
    {
        $this->battleId = $battle->id;

        $this->playerPokemon = $battle->playerPokemon->toArray();

        $this->npcPokemon = $battle->npcPokemon->toArray();
    }

    public function reload()
    {
        return redirect('/battle');
    }

    public function attack()
    {
        if (! $this->selectedMoveId) {
            return;
        }
        $battle = AttackAction::run(battleId: $this->battleId, moveId: $this->selectedMoveId);
        $this->loadBattleState($battle);
    }
}
