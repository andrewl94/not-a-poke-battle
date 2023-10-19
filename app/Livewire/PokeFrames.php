<?php

namespace App\Livewire;

use Livewire\Component;

class PokeFrames extends Component
{

    public string $sprite;
    public string $name;
    public  int $currentHealth;
    public  int $ratioHealth;

    public function render()
    {
        return view('livewire.poke-frames');
    }

}
