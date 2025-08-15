<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Visualizar Empresa') }}
            </h2>

            <x-link-button
                link="{{ route('companies.index') }}"
            > Voltar </x-link-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end gap-2">
                        <x-icon-button link="{{ route('companies.edit', $company->id) }}">
                            <x-icons.pen />
                        </x-icon-button>
                        
                        <x-icon-button link="#">
                            <x-icons.bin />
                        </x-icon-button>
                    </div>

                    @include('companies.partials.show')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>