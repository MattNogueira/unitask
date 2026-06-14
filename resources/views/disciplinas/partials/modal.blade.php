@props([
    'id',
    'title',
    'action',
    'method' => 'POST',
    'submitLabel',
    'disciplina' => null,
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
            <label for="{{ $id }}_nome" class="block text-sm font-medium uppercase text-slate-500">Nome</label>
            <input id="{{ $id }}_nome" name="nome" type="text" value="{{ old('nome', data_get($disciplina, 'nome')) }}" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="Ex: Algoritmos" required>
        </div>

        <div>
            <label for="{{ $id }}_professor" class="block text-sm font-medium uppercase text-slate-500">Professor</label>
            <input id="{{ $id }}_professor" name="professor" type="text" value="{{ old('professor', data_get($disciplina, 'professor')) }}" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="Nome do professor" required>
        </div>

        <div>
            <label for="{{ $id }}_horario" class="block text-sm font-medium uppercase text-slate-500">Horário</label>
            <input id="{{ $id }}_horario" name="horario" type="datetime-local" value="{{ old('horario', data_get($disciplina, 'horario')?->timezone('America/Sao_Paulo')->format('Y-m-d\\TH:i')) }}" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-4 text-base text-slate-950 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" required>
        </div>

        <button type="submit" class="h-[60px] w-full rounded-[14px] bg-blue-600 text-lg font-semibold text-white shadow-[0_18px_34px_rgba(37,99,235,0.26)] transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
            {{ $submitLabel }}
        </button>
    </form>
</section>
