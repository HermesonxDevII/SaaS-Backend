@props(['company_segment'])

<div
    id="popup-modal"
    tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full"
>
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm">
            <button
                type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                data-modal-hide="popup-modal"
            >
                <x-icons.close />
                <span class="sr-only">Close modal</span>
            </button>

            <form
                action="{{ route('company-segments.destroy', $company_segment->id) }}"
                method="POST"
                class="p-4 md:p-5 text-center"
            >
                @csrf
                @method('DELETE')

                <x-icons.alert />

                <h3 class="mb-5 text-lg font-normal text-gray-500">
                    Tem certeza que deseja deletar esse SEGMENTO DE EMPRESAS?
                </h3>

                <x-button
                    data-modal-hide="popup-modal"
                    type="submit"
                    warning
                > Sim, eu tenho! </x-button>

                <x-button data-modal-hide="popup-modal">
                    Não, cancelar
                </x-button>
            </form>
        </div>
    </div>
</div>