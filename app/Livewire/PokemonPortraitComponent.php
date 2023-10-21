<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class PokemonPortraitComponent extends Component
{
    public string $sprite;

    public string $name;

    public int $currentHealth;

    public int $maximumHealth;

    public bool $isThePlayer;

    #[Computed]
    public function healthPercentage()
    {
        return ceil($this->currentHealth / $this->maximumHealth * 100);
    }

    public function render()
    {
        return view('livewire.pokemon-portrait');
    }
}
