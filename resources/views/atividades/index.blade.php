<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Minhas Tarefas</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>[x-cloak] { display: none !important; }</style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="overflow-x-hidden font-sans text-slate-950 antialiased">
        @php
            $priorityLabels = [
                3 => 'Alta',
                2 => 'Média',
                1 => 'Baixa',
            ];

            $hasPriorityFilter = in_array($prioridade, [1, 2, 3], true);
            $hasStatusFilter = in_array($status, ['sim', 'nao'], true);
        @endphp

        <main class="min-h-screen bg-slate-100 lg:flex" x-data="{ activeModal: '{{ request('modal') === 'create' ? 'atividade-create' : '' }}' }">
            @include('partials.app-sidebar', ['active' => 'atividades'])

            <div class="mx-auto flex min-h-screen w-full max-w-[540px] flex-col bg-slate-100 lg:mx-0 lg:max-w-none lg:flex-1">
                @if (session('status') === 'atividade-removida')
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2600)"
                        class="fixed left-1/2 top-3 z-50 -translate-x-1/2 rounded-[12px] bg-slate-950 px-6 py-3 text-base font-medium text-white shadow-[0_18px_34px_rgba(15,23,42,0.26)]"
                    >
                        Tarefa removida
                    </div>
                @endif

                <header x-data="{ priorityOpen: {{ $hasPriorityFilter ? 'true' : 'false' }}, completedOpen: {{ $hasStatusFilter ? 'true' : 'false' }} }" class="bg-white px-5 pb-5 pt-14 lg:border-b lg:border-slate-200 lg:px-10 lg:pt-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('dashboard') }}" class="flex h-11 w-11 items-center justify-center rounded-[14px] bg-slate-100 text-slate-950" aria-label="Voltar ao dashboard">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M15 6 9 12l6 6M10 12h10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <h1 class="text-2xl font-medium lg:text-3xl">Minhas Tarefas</h1>
                        </div>

                        <button type="button" x-on:click="activeModal = 'atividade-create'" class="hidden h-11 items-center gap-2 rounded-[14px] bg-blue-600 px-5 font-medium text-white lg:flex">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            Nova tarefa
                        </button>
                    </div>

                    <div class="mt-5 flex flex-wrap gap-2">
                        <a href="{{ route('atividades.index') }}" class="{{ ! $hasPriorityFilter && ! $hasStatusFilter ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }} rounded-[10px] px-4 py-2 text-sm font-medium">
                            Todas
                        </a>

                        @if ($hasPriorityFilter)
                            <a href="{{ route('atividades.index') }}" class="inline-flex items-center gap-2 rounded-[10px] bg-blue-600 px-4 py-2 text-sm font-medium text-white">
                                Prioridade
                                <svg class="h-4 w-4 rotate-180 transition" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.17l3.71-3.94a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <button type="button" x-on:click="priorityOpen = ! priorityOpen" class="inline-flex items-center gap-2 rounded-[10px] bg-slate-100 px-4 py-2 text-sm font-medium text-slate-500 hover:bg-slate-200">
                                Prioridade
                                <svg class="h-4 w-4 transition" x-bind:class="{ 'rotate-180': priorityOpen }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.17l3.71-3.94a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        @endif

                        @if ($hasStatusFilter)
                            <a href="{{ route('atividades.index') }}" class="inline-flex items-center gap-2 rounded-[10px] bg-blue-600 px-4 py-2 text-sm font-medium text-white">
                                Concluída
                                <svg class="h-4 w-4 rotate-180 transition" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.17l3.71-3.94a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <button type="button" x-on:click="completedOpen = ! completedOpen" class="inline-flex items-center gap-2 rounded-[10px] bg-slate-100 px-4 py-2 text-sm font-medium text-slate-500 hover:bg-slate-200">
                                Concluída
                                <svg class="h-4 w-4 transition" x-bind:class="{ 'rotate-180': completedOpen }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.17l3.71-3.94a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        @endif

                        <div x-cloak x-show="priorityOpen" x-transition class="flex basis-full gap-2 overflow-x-auto pb-1">
                            @foreach ($priorityLabels as $value => $label)
                                <a href="{{ $prioridade === $value ? route('atividades.index') : route('atividades.index', ['prioridade' => $value]) }}" class="{{ $prioridade === $value ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }} rounded-[10px] px-4 py-2 text-sm font-medium">
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>

                        <div x-cloak x-show="completedOpen" x-transition class="flex basis-full gap-2 overflow-x-auto pb-1">
                            <a href="{{ $status === 'sim' ? route('atividades.index') : route('atividades.index', ['status' => 'sim']) }}" class="{{ $status === 'sim' ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }} rounded-[10px] px-4 py-2 text-sm font-medium">
                                Sim
                            </a>

                            <a href="{{ $status === 'nao' ? route('atividades.index') : route('atividades.index', ['status' => 'nao']) }}" class="{{ $status === 'nao' ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }} rounded-[10px] px-4 py-2 text-sm font-medium">
                                Não
                            </a>
                        </div>
                    </div>
                </header>

                <section class="flex-1 px-5 py-5 pb-28 lg:px-10 lg:pb-10">
                    <div class="space-y-3 lg:grid lg:grid-cols-2 lg:gap-4 lg:space-y-0 xl:grid-cols-3">
                        @forelse ($atividades as $atividade)
                            @php
                                $completed = (int) $atividade->status === \App\Enums\StatusAtividadeEnum::CONCLUIDA->value;
                                $late = (int) $atividade->status === \App\Enums\StatusAtividadeEnum::ATRASADA->value;
                                $priorityClass = match ((int) $atividade->prioridade) {
                                    3 => 'border-l-red-500',
                                    2 => 'border-l-amber-500',
                                    default => 'border-l-green-500',
                                };
                            @endphp

                            <article class="{{ $completed ? 'opacity-70' : '' }} flex min-h-[80px] w-full max-w-full items-center gap-3 overflow-hidden rounded-[18px] border-l-2 {{ $priorityClass }} bg-white px-4 py-4 sm:gap-4 sm:px-5">
                                <form method="POST" action="{{ route('atividades.concluir', $atividade) }}" class="shrink-0">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="{{ $completed ? 'border-blue-600 bg-blue-600 text-white' : 'border-slate-300 text-transparent hover:border-blue-600' }} flex h-8 w-8 items-center justify-center rounded-full border-2" aria-label="{{ $completed ? 'Reabrir tarefa' : 'Marcar como concluída' }}">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="m6 12 4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>

                                <button type="button" x-on:click="activeModal = 'atividade-edit-{{ $atividade->id }}'" class="min-w-0 flex-1 text-left">
                                    <p class="{{ $completed ? 'text-slate-500 line-through' : 'text-slate-950' }} flex min-w-0 items-center gap-2 text-base font-medium sm:text-lg">
                                        <span class="truncate">{{ $atividade->titulo }}</span>
                                        @if ($late)
                                            <span class="shrink-0 text-red-500" aria-label="Tarefa atrasada">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                    <path d="M12 8v5M12 17h.01M10.3 4.5 2.7 18a1.5 1.5 0 0 0 1.3 2.2h16a1.5 1.5 0 0 0 1.3-2.2L13.7 4.5a1.9 1.9 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        @endif
                                    </p>
                                    <p class="{{ $completed ? 'line-through' : '' }} mt-1 truncate text-xs text-slate-500 sm:text-base">{{ $atividade->disciplina->nome }} · {{ $atividade->prazo->timezone('America/Sao_Paulo')->format('d/m H:i') }}</p>
                                    @if ($late)
                                        <span class="mt-2 inline-flex rounded-full bg-red-50 px-3 py-1 text-xs font-medium text-red-600">Atrasada</span>
                                    @endif
                                </button>

                                <form method="POST" action="{{ route('atividades.destroy', $atividade) }}" class="shrink-0">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-slate-300 hover:text-red-500" aria-label="Remover tarefa">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M9 6h6M10 10v7M14 10v7M5 6h14M7 6l1 14h8l1-14M10 6l.7-2h2.6L14 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>
                            </article>
                        @empty
                            <div class="rounded-[18px] bg-white px-5 py-8 lg:col-span-full">
                                <p class="text-center text-lg text-slate-500">
                                    {{ $hasPriorityFilter || $hasStatusFilter ? 'Nenhuma tarefa encontrada para os filtros aplicados.' : 'Nenhuma tarefa cadastrada 🎉' }}
                                </p>
                            </div>
                        @endforelse
                    </div>
                </section>

                @include('partials.mobile-bottom-nav', [
                    'active' => 'atividades',
                    'createClick' => "activeModal = 'atividade-create'",
                    'createLabel' => 'Adicionar tarefa',
                ])
            </div>

            <div x-cloak x-show="activeModal" class="fixed inset-0 z-50 flex items-end justify-center lg:items-center" aria-modal="true" role="dialog">
                <button type="button" x-on:click="activeModal = null" class="absolute inset-0 bg-slate-950/40 backdrop-blur-sm" aria-label="Fechar modal"></button>

                @include('atividades.partials.modal', [
                    'id' => 'atividade-create',
                    'title' => 'Nova Tarefa',
                    'action' => route('atividades.store'),
                    'submitLabel' => 'Salvar Tarefa',
                    'disciplinas' => $disciplinas,
                ])

                @foreach ($atividades as $atividade)
                    @include('atividades.partials.modal', [
                        'id' => 'atividade-edit-' . $atividade->id,
                        'title' => 'Editar Tarefa',
                        'action' => route('atividades.update', $atividade),
                        'method' => 'PUT',
                        'submitLabel' => 'Salvar Alterações',
                        'disciplinas' => $disciplinas,
                        'atividade' => $atividade,
                    ])
                @endforeach
            </div>
        </main>
    </body>
</html>
