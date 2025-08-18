<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Visualizar Equipe Responsável') }}
            </h2>

            <x-link-button link="{{ route('responsible-teams.index') }}">
                Voltar
            </x-link-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end gap-2">
                        <x-icons.components.link link="{{ route('responsible-teams.edit', $responsible_team->id) }}">
                            <x-icons.pen />
                        </x-icons.components.link>
                        
                        <x-icons.components.button
                            data-modal-target="popup-modal"
                            data-modal-toggle="popup-modal"
                        >
                            <x-icons.bin />
                        </x-icons.components.button>
                    </div>

                    @include('responsible-teams.partials.show')
                </div>
            </div>
        </div>
    </div>

    <x-responsible-team::delete-modal
        :responsible_team="$responsible_team"
    />
</x-app-layout>