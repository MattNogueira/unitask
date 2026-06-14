@props([
    'id',
    'title',
    'action',
    'method' => 'POST',
    'submitLabel',
    'disciplinas',
    'atividade' => null,
])

<section x-show="activeModal === '{{ $id }}'" x-transition class="relative flex max-h-[92vh] w-full max-w-[540px] flex-col overflow-hidden rounded-t-[28px] bg-white px-6 pb-8 pt-6 shadow-[0_-24px_60px_rgba(15,23,42,0.22)] lg:max-w-[520px] lg:rounded-[28px]">
    <div class="mx-auto mb-7 h-1 w-12 shrink-0 rounded-full bg-slate-200"></div>
    <h2 class="shrink-0 text-2xl font-medium text-slate-950">{{ $title }}</h2>

    <form method="POST" action="{{ $action }}" class="modal-scroll mt-8 min-h-0 flex-1 space-y-5 overflow-y-auto pr-1">
        @csrf
        @if (strtoupper($method) !== 'POST')
            @method($method)
        @endif

        <div>
            <label for="{{ $id }}_titulo" class="block text-sm font-medium uppercase text-slate-500">Nome da tarefa</label>
            <input id="{{ $id }}_titulo" name="titulo" type="text" value="{{ old('titulo', data_get($atividade, 'titulo')) }}" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="Ex: Entregar relatório" required>
        </div>

        <div>
            <label for="{{ $id }}_descricao" class="block text-sm font-medium uppercase text-slate-500">Descrição</label>
            <textarea id="{{ $id }}_descricao" name="descricao" rows="3" class="mt-2 w-full resize-none rounded-[14px] border border-slate-200 bg-slate-50 px-5 py-4 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="Detalhes importantes da tarefa">{{ old('descricao', data_get($atividade, 'descricao')) }}</textarea>
        </div>

        <div>
            <label for="{{ $id }}_disciplina" class="block text-sm font-medium uppercase text-slate-500">Disciplina</label>
            <select id="{{ $id }}_disciplina" name="id_disciplina" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" required>
                @forelse ($disciplinas as $disciplina)
                    <option value="{{ $disciplina->id }}" @selected((int) old('id_disciplina', data_get($atividade, 'id_disciplina')) === $disciplina->id)>{{ $disciplina->nome }}</option>
                @empty
                    <option value="">Cadastre uma disciplina primeiro</option>
                @endforelse
            </select>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label for="{{ $id }}_prazo" class="block text-sm font-medium uppercase text-slate-500">Data de entrega</label>
                <input id="{{ $id }}_prazo" name="prazo" type="datetime-local" min="{{ now('America/Sao_Paulo')->format('Y-m-d\\TH:i') }}" value="{{ old('prazo', data_get($atividade, 'prazo')?->timezone('America/Sao_Paulo')->format('Y-m-d\\TH:i')) }}" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-4 text-base text-slate-950 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" required>
            </div>

            <div>
                <label for="{{ $id }}_prioridade" class="block text-sm font-medium uppercase text-slate-500">Prioridade</label>
                <select id="{{ $id }}_prioridade" name="prioridade" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" required>
                    <option value="1" @selected((int) old('prioridade', data_get($atividade, 'prioridade', 2)) === 1)>Baixa</option>
                    <option value="2" @selected((int) old('prioridade', data_get($atividade, 'prioridade', 2)) === 2)>Média</option>
                    <option value="3" @selected((int) old('prioridade', data_get($atividade, 'prioridade', 2)) === 3)>Alta</option>
                </select>
            </div>
        </div>

        <button type="submit" class="h-[60px] w-full rounded-[14px] bg-blue-600 text-lg font-semibold text-white shadow-[0_18px_34px_rgba(37,99,235,0.26)] transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
            {{ $submitLabel }}
        </button>
    </form>
</section>
