<div class="flex flex-col">
    <x-input-box>
        <x-input-with-label
            label="Nome"
            name="name"
            :value="$solicitation_type->name"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-textarea-with-label
            label="Descrição"
            name="description"
            :value="$solicitation_type->description ?? 'Sem Descrição'"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Status"
            name="status"
            value="{{ $solicitation_type->active ? 'Ativo' : 'Inativo' }}"
            readonly
        />
    </x-input-box>
</div>