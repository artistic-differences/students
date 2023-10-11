<div>
    <h1 class="text-xl">Hello Livewire!</h1>
    <x-filament::button wire:click="increment">
        +
    </x-filament::button>
    <x-filament::button wire:click="decrement">
        -
    </x-filament::button>
    <h1>{{ $count }}</h1>
</div>
