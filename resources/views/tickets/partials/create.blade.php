<x-alerts />

<form
    action="{{ route('tickets.store') }}"
    method="POST"
    class="flex flex-col"
    enctype="multipart/form-data"
>
    @csrf
    <div class="flex flex-row gap-3">
        <div class="w-[75%] p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <x-input-with-label
                label="Título *"
                name="title"
                placeholder="Digite o Título"
                required
            />

            <x-select-with-label
                label="Empresa *"
                name="company"
                :options="$companies"
                optionField="corporate_reason"
                placeholder="Selecione uma Empresa"
                required
            />

            <x-textarea-with-label
                label="Descrição"
                name="description"
                placeholder="Digite uma Descrição"
            />
            
            <x-select-with-label
                label="Tipo de Solicitação  *"
                name="solicitation_type"
                :options="$solicitation_types"
                placeholder="Selecione um Tipo de Solicitação"
            />
            
            <x-select-with-label
                label="Equipe Responsável *"
                name="responsible_team"
                :options="$responsible_teams"
                placeholder="Selecione uma Equipe Responsável"
            />
            
            <x-select-with-label
                label="Prioridade *"
                name="priority"
                :options="$priorities"
                placeholder="Selecione uma Prioridade"
            />

            <div class="w-full flex flex-row justify-end gap-2">
                <x-button type="submit">Salvar</x-button>
                <x-link-button
                    link="{{ route('tickets.index') }}"
                    warning
                > Cancelar </x-link-button>
            </div>
        </div>

        <div class="w-[25%] p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <h2 class="ml-0.5 mb-2">Anexos</h2>
            <x-input-box>
                <x-inputfile-with-label />
            </x-input-box>
        </div>
    </div>
</form>