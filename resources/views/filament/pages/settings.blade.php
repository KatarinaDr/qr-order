<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <x-filament::button type="submit" color="primary" class="mt-6">
            Save Settings
        </x-filament::button>
    </form>
</x-filament::page>
