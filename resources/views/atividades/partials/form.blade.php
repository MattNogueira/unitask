@php
    $atividade ??= null;
@endphp

<div>
    <x-input-label for="titulo" value="Título" />
    <x-text-input id="titulo" name="titulo" type="text" class="mt-1 block w-full" :value="old('titulo', data_get($atividade, 'titulo'))" required autofocus />
    <x-input-error class="mt-2" :messages="$errors->get('titulo')" />
</div>

<div>
    <x-input-label for="descricao" value="Descrição" />
    <textarea id="descricao" name="descricao" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">{{ old('descricao', data_get($atividade, 'descricao')) }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('descricao')" />
</div>

<div>
    <x-input-label for="id_disciplina" value="Disciplina" />
    <select id="id_disciplina" name="id_disciplina" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" required>
        @foreach ($disciplinas as $disciplina)
            <option value="{{ $disciplina->id }}" @selected((int) old('id_disciplina', data_get($atividade, 'id_disciplina')) === $disciplina->id)>
                {{ $disciplina->nome }}
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('id_disciplina')" />
</div>

<div class="grid gap-5 sm:grid-cols-2">
    <div>
        <x-input-label for="prazo" value="Prazo" />
        <x-text-input id="prazo" name="prazo" type="datetime-local" class="mt-1 block w-full" min="{{ now('America/Sao_Paulo')->format('Y-m-d\\TH:i') }}" :value="old('prazo', data_get($atividade, 'prazo')?->timezone('America/Sao_Paulo')->format('Y-m-d\\TH:i'))" required />
        <x-input-error class="mt-2" :messages="$errors->get('prazo')" />
    </div>

    <div>
        <x-input-label for="prioridade" value="Prioridade" />
        <select id="prioridade" name="prioridade" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" required>
            <option value="1" @selected((int) old('prioridade', data_get($atividade, 'prioridade', 1)) === 1)>Baixa</option>
            <option value="2" @selected((int) old('prioridade', data_get($atividade, 'prioridade', 2)) === 2)>Média</option>
            <option value="3" @selected((int) old('prioridade', data_get($atividade, 'prioridade')) === 3)>Alta</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('prioridade')" />
    </div>
</div>
