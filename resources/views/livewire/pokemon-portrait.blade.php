<div class="grid grid-cols-1 place-items-center">
    <figure>
        <img src="{{ $sprite }}" alt="Player Pokemon">
    </figure>
    <span class="capitalize">{{ $name }}</span>

    <div class="h-2 w-32 bg-slate-200  border border-slate-400">
        <div class="h-2 w-full  {{ $this->healthPercentage > 50 ? 'bg-green-400' : 'bg-red-400' }} "></div>
    </div>

    <span class="text-sm">HP: {{ $currentHealth }}</span>

</div>
