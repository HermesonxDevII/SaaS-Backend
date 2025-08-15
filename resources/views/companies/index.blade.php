<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Empresas Cadastradas') }}
            </h2>

            <x-link-button link="{{ route('registrations.index') }}"> Voltar </x-link-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-end mb-5">
                        <x-icon-button link="{{ route('companies.create') }}">
                            <x-icons.plus />
                        </x-icon-button>
                    </div>

                    <x-company::table
                        :companies="$companies"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>