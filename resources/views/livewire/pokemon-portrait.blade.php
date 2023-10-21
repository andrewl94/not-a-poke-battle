<div class="grid grid-cols-1 place-items-center col-span-2">
    <span>{{ $isThePlayer ? 'You' : 'Opponent' }}</span>
    <figure>
        <img src="{{ $sprite }}" alt="Pokemon">
    </figure>
    <span class="capitalize">{{ $name }}</span>

    <div class="h-2 w-32 bg-slate-200  border border-slate-400">
        <div
            class="
                h-2
                {{ $this->healthPercentage > 80 ? 'w-full' : ($this->healthPercentage > 50 ? 'w-1/2' : ($this->healthPercentage > 0 ? 'w-1/4' : 'w-0')) }}
                {{ $this->healthPercentage > 50 ? 'bg-green-400' : 'bg-red-400' }}
            ">
        </div>
    </div>

    <span class="text-sm">HP: {{ $currentHealth }}</span>

</div>
