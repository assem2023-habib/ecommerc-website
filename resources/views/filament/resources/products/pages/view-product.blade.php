<x-filament::page>
    <div class="space-y-6">
        <div class="grid gap-6">
            <x-filament::section>
                <x-slot name="heading">
                    {{ $this->getTitle() }}
                </x-slot>

                <div class="space-y-6">
                    @foreach($this->getFormSchema() as $component)
                        {{ $component }}
                    @endforeach
                </div>
            </x-filament::section>
        </div>
    </div>

    @if($this->hasForms)
        <x-filament-actions-modal />
    @endif
</x-filament::page>
