<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Adicionar Ticket') }}
            </h2>

            <x-link-button link="{{ route('tickets.index') }}"> Voltar </x-link-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-gray-900">
                @include('tickets.partials.create')
            </div>
        </div>
    </div>
</x-app-layout>