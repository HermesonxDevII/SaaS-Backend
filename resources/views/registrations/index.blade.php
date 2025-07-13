<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-table>
                        <x-slot name="head">
                            <x-table-head :fields="$fields" />
                        </x-slot>

                        <x-slot name="body">
                            <x-table-body
                                :objects="$values"
                                :showQuantity="true"
                            />
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
