<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Nova disciplina</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('disciplinas.store') }}" class="space-y-5 rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
                @csrf

                <div>
                    <x-input-label for="nome" value="Nome" />
                    <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-full" :value="old('nome')" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('nome')" />
                </div>

                <div>
                    <x-input-label for="professor" value="Professor" />
                    <x-text-input id="professor" name="professor" type="text" class="mt-1 block w-full" :value="old('professor')" required />
                    <x-input-error class="mt-2" :messages="$errors->get('professor')" />
                </div>

                <div>
                    <x-input-label for="horario" value="Horário" />
                    <x-text-input id="horario" name="horario" type="datetime-local" class="mt-1 block w-full" :value="old('horario')" required />
                    <x-input-error class="mt-2" :messages="$errors->get('horario')" />
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('disciplinas.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">Cancelar</a>
                    <x-primary-button>Salvar</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
