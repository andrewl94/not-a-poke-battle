<section class="container m-auto px-2 lg:px-6 place-items-center justify-items-center">


    @if ($gameLoaded === false)
        <div class="py-8">
            Unable to load the game. Try refreshing the page.
        </div>
    @endif


    @if ($gameLoaded === true)
        <div class="grid grid-cols-2 py-8 w-full h-56">

            @livewire(
                'poke-frames',
                [
                    'sprite' => $player->pokemon->info->sprite,
                    'name' => $player->pokemon->name,
                    'currentHealth' => $playerHealth['current'],
                    'ratioHealth' => $playerHealth['ratio'],
                ],
                key($player->pokemon->name . '_' . $playerHealth['current'])
            )

            @livewire(
                'poke-frames',
                [
                    'sprite' => $npc->pokemon->info->sprite,
                    'name' => $npc->pokemon->name,
                    'currentHealth' => $npcHealth['current'],
                    'ratioHealth' => $npcHealth['ratio'],
                ],
                key($npc->pokemon->name . '_' . $npcHealth['current'])
            )


        </div>

        <div class="grid grid-cols-1 place-items-center">
            <span class="text-lg py-2">Choose your move</span>
            <select class="capitalize" name="move" wire:model="selectedMove">
                <option class="text-center" value="">-</option>
                @foreach ($player->pokemon->info->moves as $move)
                    <option value="{{ $move->name }}" class="text-center">{{ $move->name }}</option>
                @endforeach
            </select>

            <button class="bg-red-600 rounded-lg w-20 h-12 text-white my-4" wire:click="attack">Attack</button>
        </div>

        @if ($gameState === false)
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

        @if ($gameState === true)
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

        <div class="py-6">
            <div class="text-lg text-center">Battle Log</div>
            <div class="grid grid-cols-1 place-items-center">
                @foreach ($battleLog as $log)
                    <div> <strong class="capitalize">{{ $log['pokemonName'] }}</strong> used <span
                            class="capitalize">{{ $log['move'] }}</span> and delt {{ $log['damage'] }} damage. </div>
                @endforeach
            </div>
        </div>

    @endif
</section>
