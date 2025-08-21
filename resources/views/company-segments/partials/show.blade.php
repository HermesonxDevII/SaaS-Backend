<div class="flex flex-col">
    <x-input-box>
        <x-input-with-label
            label="Nome"
            name="name"
            :value="$company_segment->name"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-textarea-with-label
            label="Descrição"
            name="description"
            :value="$company_segment->description ?? 'Sem Descrição'"
            readonly
        />
    </x-input-box>

    <x-input-box>
        <x-input-with-label
            label="Status"
            name="status"
            value="{{ $company_segment->active ? 'Ativo' : 'Inativo' }}"
            readonly
        />
    </x-input-box>
</div>