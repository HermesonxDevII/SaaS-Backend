@props([
    'ticket',
    'isEditable',
    'solicitation_types',
    'priorities',
    'responsible_teams'
])

<form
    method="POST"
    action="{{ route('tickets.soft-update', $ticket->id) }}"
    class="w-[25%] p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg"
    x-data="{
        hasChanged: false,
        
        formData: {
            solicitation_type: '{{ $ticket->solicitation_type_id }}',
            responsible_team: '{{ $ticket->responsible_team_id }}',
            priority: '{{ $ticket->priority_id }}'
        },

        checkIfFormHasChanged() {
            const initialSolicitationType = '{{ $ticket->solicitation_type_id }}';
            const initialResponsibleTeam = '{{ $ticket->responsible_team_id }}';
            const initialPriority = '{{ $ticket->priority_id }}';

            if (this.formData.solicitation_type != initialSolicitationType ||
                this.formData.responsible_team != initialResponsibleTeam ||
                this.formData.priority != initialPriority) {
                this.hasChanged = true;
            } else {
                this.hasChanged = false;
            }
        }
    }"
>
    @method('PUT')
    @csrf

    <div class="flex flex-row justify-between items-center mb-3">
        <h2 class="ml-0.5 font-bold">Propriedades</h2>

        @if ($isEditable)
            <div
                x-show="hasChanged"
                x-transition
            >
                <x-button
                    width="px-3"
                    height="py-1"
                    type="submit"
                >Salvar</x-button>
            </div>
        @endif
    </div>

    @if ($isEditable)
        <x-input-with-label
            label="Status"
            name="status"
            placeholder="Aguardando Atendimento"
            x-model="formData.status"
            @change="checkIfFormHasChanged()"
            readonly
        />

        <x-select-with-label
            label="Tipo de Solicitação"
            name="solicitation_type"
            :value="$ticket->solicitation_type_id"
            :options="$solicitation_types"
            placeholder="Selecione um Tipo de Solicitação"
            x-model="formData.solicitation_type"
            @change="checkIfFormHasChanged()"
        />
        
        <x-select-with-label
            label="Equipe Responsável"
            name="responsible_team"
            :value="$ticket->responsible_team_id"
            :options="$responsible_teams"
            placeholder="Selecione uma Equipe Responsável"
            x-model="formData.responsible_team"
            @change="checkIfFormHasChanged()"
        />
        
        <x-select-with-label
            label="Prioridade"
            name="priority"
            :value="$ticket->priority_id"
            :options="$priorities"
            placeholder="Selecione uma Prioridade"
            x-model="formData.priority"
            @change="checkIfFormHasChanged()"
        />
    @else
        <x-input-with-label
            label="Tipo de Solicitação"
            name="solicitation_type"
            :value="$ticket->solicitationType->name"
            readonly
        />
        <x-input-with-label
            label="Equipe Responsável"
            name="responsible_team"
            :value="$ticket->responsibleTeam->name"
            readonly
        />
        <x-input-with-label
            label="Prioridade"
            name="priority"
            :value="$ticket->priority->name"
            readonly
        />
    @endif
</form>