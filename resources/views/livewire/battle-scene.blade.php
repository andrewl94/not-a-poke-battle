<div class="container m-auto px-2 lg:px-6 place-items-center grid grid-cols-1 h-screen">

    <div class="grid grid-cols-5 py-8 w-full h-56">

        @livewire(
            'pokemon-portrait-component',
            [
                'sprite' => $playerPokemon['sprite'],
                'name' => $playerPokemon['name'],
                'currentHealth' => $playerPokemon['stats']['currentHp'],
                'maximumHealth' => $playerPokemon['stats']['hp'],
                'isThePlayer' => true,
            ],
            key($playerPokemon['id'] . $playerPokemon['stats']['currentHp'])
        )

        <div class="grid grid-cols-1 place-items-center">
            <figure class="w-32 h-32">
                <img src="https://www.creativefabrica.com/wp-content/uploads/2021/11/29/Versus-Vs-Text-Vector-Transparent-Design-Graphics-20948405-2-580x377.png"
                    alt="Versus" class="object-cover object-center w-full h-full" />
            </figure>
        </div>
        @livewire(
            'pokemon-portrait-component',
            [
                'sprite' => $npcPokemon['sprite'],
                'name' => $npcPokemon['name'],
                'currentHealth' => $npcPokemon['stats']['currentHp'],
                'maximumHealth' => $npcPokemon['stats']['hp'],
                'isThePlayer' => false,
            ],
            key($npcPokemon['id'] . $npcPokemon['stats']['currentHp'])
        )

    </div>

    <div class="grid grid-cols-1 place-items-center">
        <span class="text-lg py-2">Choose your move</span>
        <select class="capitalize" name="move" wire:model="selectedMoveId">
            <option class="text-center" value="">-</option>
            @foreach ($playerPokemon['moves'] as $move)
                <option value="{{ $move['id'] }}" class="text-center">{{ $move['name'] }}</option>
            @endforeach
        </select>

        <button class="bg-red-600 rounded-lg w-20 h-12 text-white my-4" wire:click="attack">Attack</button>
    </div>

    @if (0 >= $playerPokemon['stats']['currentHp'])
        <div class="mx-auto place-items-center grid grid-cols-1 ">
            <figure class="w-80 h-80">
                <img class="object-center object-contain w-full h-full"
                    src="https://i.kym-cdn.com/entries/icons/original/000/029/198/Dark_Souls_You_Died_Screen_-_Completely_Black_Screen_0-2_screenshot.png"
                    alt="You lost">
            </figure>
            <button class="bg-blue-600 rounded-lg w-40 h-12 text-white my-4" wire:click="reload">Reload to play
                again</button>
        </div>
    @endif

    @if (0 >= $npcPokemon['stats']['currentHp'])
        <div class="mx-auto place-items-center grid grid-cols-1 ">
            <figure class="w-80 h-80">
                <img class="object-center object-contain  w-full h-full"
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiPL9VrEio_wgVsSyaaaJMYgf-c_xYcJcvrZXPCEMUPRmZ6N1OwQO2wDiXywMZwi1vloY&usqp=CAU"
                    alt="You win">
            </figure>
            <button class="bg-blue-600 rounded-lg w-40 h-12 text-white my-4" wire:click="reload">Reload to play
                again</button>
        </div>
    @endif

</div>
