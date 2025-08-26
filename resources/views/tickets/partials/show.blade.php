<div>
    <div class="flex flex-row gap-3">
        <x-ticket::side-left
            :company="$ticket->company"
        />

        <div class="w-[50%] flex flex-col gap-3">
            <div class="p-1 bg-white overflow-hidden shadow-sm sm:rounded-t-lg">
                <div class="flex flex-col gap-0.5">
                    <x-ticket::tab-bar
                        :ticket="$ticket"
                    />
                </div>
            </div>

            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($isEditable)
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-col gap-0.5">
                            <p class="ml-0.5 text-xs text-gray-500">Criado em: {{ $ticket->created_at_extenso }}</p>
                            <p class="ml-0.5 text-xs text-gray-500">Criado por: {{ $ticket->user->name }} &lt;{{ $ticket->user->email }}&gt;</p>
                        </div>

                        <h2 class="ml-0.5 font-bold">{{ $ticket->title }}</h2>
                    </div>

                    <div class="border-b border-gray-200 mt-3 mb-3"></div>

                    <p>{{ $ticket->description }}</p>

                    {{--
                        <x-input-with-label
                            label="Título"
                            name="title"
                            :value="$ticket->title"
                            placeholder="Digite o Título"
                            required
                        />

                        <x-textarea-with-label
                            label="Descrição"
                            name="description"
                            :value="$ticket->description"
                            placeholder="Digite uma Descrição"
                            rows="8"
                            required
                        />
                    --}}
                @else
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-col gap-0.5">
                            <p class="ml-0.5 text-xs text-gray-500">Criado em: {{ $ticket->created_at_extenso }}</p>
                            <p class="ml-0.5 text-xs text-gray-500">Criado por: {{ $ticket->user->name }} &lt;{{ $ticket->user->email }}&gt;</p>
                        </div>

                        <h2 class="ml-0.5 font-bold">{{ $ticket->title }}</h2>
                    </div>

                    <div class="border-b border-gray-200 mt-3 mb-3"></div>

                    <p>{{ $ticket->description }}</p>
                @endif
            </div>
        </div>

        <x-ticket::side-right
            :ticket="$ticket"
            :isEditable="$isEditable"
            :solicitation_types="$solicitation_types"
            :priorities="$priorities"
            :responsible_teams="$responsible_teams"
        />
    </div>
</div>