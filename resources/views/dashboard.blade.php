<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Unitask</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>[x-cloak] { display: none !important; }</style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="overflow-x-hidden font-sans text-slate-950 antialiased">
        @php
            $today = now('America/Sao_Paulo');
            $weekStart = $today->copy()->startOfWeek(\Carbon\CarbonInterface::SUNDAY);
            $weekDays = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'];
            $months = [
                1 => 'Janeiro',
                2 => 'Fevereiro',
                3 => 'Marco',
                4 => 'Abril',
                5 => 'Maio',
                6 => 'Junho',
                7 => 'Julho',
                8 => 'Agosto',
                9 => 'Setembro',
                10 => 'Outubro',
                11 => 'Novembro',
                12 => 'Dezembro',
            ];
        @endphp

        <main class="min-h-screen bg-slate-100 lg:flex" x-data="{ activeModal: null }">
            @include('partials.app-sidebar', ['active' => 'dashboard'])

            <div class="mx-auto flex min-h-screen w-full max-w-[540px] flex-col bg-slate-100 shadow-[0_0_80px_rgba(15,23,42,0.08)] lg:mx-0 lg:max-w-none lg:flex-1 lg:shadow-none">
                <header class="bg-white px-7 pb-7 pt-16 lg:border-b lg:border-slate-200 lg:px-10 lg:pb-8 lg:pt-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base text-slate-500">Bem-vindo(a) de volta!</p>
                            <h1 class="mt-1 text-[26px] font-medium leading-tight text-slate-950 lg:text-4xl">{{ auth()->user()->nome }}</h1>
                        </div>

                        <div class="flex items-center gap-3">
                            <p class="hidden max-w-[260px] truncate text-base font-medium text-slate-500 lg:block">{{ auth()->user()->email }}</p>

                            <a href="{{ route('profile.edit') }}" class="flex h-[52px] w-[52px] items-center justify-center rounded-full bg-blue-100 text-blue-600" aria-label="Perfil">
                                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 12a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4Z" stroke="currentColor" stroke-width="1.8" />
                                    <path d="M6.8 19.2v-1.1c0-2.1 1.7-3.8 3.8-3.8h2.8c2.1 0 3.8 1.7 3.8 3.8v1.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </header>

                <div class="flex-1 px-7 pb-28 pt-6 lg:px-10 lg:pb-10 lg:pt-8">
                    <div class="lg:grid lg:grid-cols-[minmax(0,1fr)_360px] lg:gap-8 xl:grid-cols-[minmax(0,1fr)_400px]">
                        <div class="min-w-0">
                            <section>
                                <div class="mb-4 flex items-center justify-between">
                                    <h2 class="text-xl font-medium text-slate-950 lg:text-2xl">{{ $months[(int) $today->format('n')] }} {{ $today->format('Y') }}</h2>
                                    <a href="#" class="text-base font-medium text-blue-600 hover:text-blue-700">Ver tudo</a>
                                </div>

                                <div class="grid grid-cols-7 gap-2 lg:gap-3">
                                    @foreach ($weekDays as $index => $label)
                                        @php
                                            $date = $weekStart->copy()->addDays($index);
                                            $isToday = $date->isSameDay($today);
                                        @endphp

                                        <button type="button" class="{{ $isToday ? 'bg-blue-600 text-white shadow-[0_10px_18px_rgba(37,99,235,0.28)]' : 'bg-white text-slate-950' }} flex h-[67px] min-w-0 flex-col items-center justify-center rounded-[14px] lg:h-[88px]">
                                            <span class="{{ $isToday ? 'text-blue-100' : 'text-slate-500' }} text-xs font-medium lg:text-sm">{{ $label }}</span>
                                            <span class="mt-1 text-lg font-medium lg:text-2xl">{{ $date->format('j') }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </section>

                            <section id="tarefas-hoje" class="mt-9 lg:hidden">
                                <div class="mb-5 flex items-center justify-between">
                                    <h2 class="text-xl font-medium text-slate-950 lg:text-2xl">Tarefas de Hoje</h2>
                                    <button type="button" x-on:click="activeModal = 'atividade-create'" class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-blue-600 text-white shadow-[0_12px_24px_rgba(37,99,235,0.24)] lg:hidden" aria-label="Adicionar atividade">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="grid gap-4">
                                    @forelse ($atividadesHoje as $atividade)
                                        @php
                                            $late = (int) data_get($atividade, 'status') === \App\Enums\StatusAtividadeEnum::ATRASADA->value;
                                            $priorityClass = match ((int) data_get($atividade, 'prioridade')) {
                                                3 => 'border-l-red-500',
                                                2 => 'border-l-amber-500',
                                                default => 'border-l-green-500',
                                            };
                                        @endphp

                                        <article class="flex min-h-[80px] w-full max-w-full items-center gap-3 overflow-hidden rounded-[18px] border-l-2 {{ $priorityClass }} bg-white px-4 py-4 sm:gap-4 sm:px-5">
                                            <form method="POST" action="{{ route('atividades.concluir', $atividade) }}" class="shrink-0">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-slate-300 text-transparent hover:border-blue-600" aria-label="Marcar como concluída">
                                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                        <path d="m6 12 4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <button type="button" x-on:click="activeModal = 'atividade-edit-{{ $atividade->id }}'" class="min-w-0 flex-1 text-left">
                                                <p class="flex min-w-0 items-center gap-2 text-base font-medium text-slate-950 sm:text-lg">
                                                    <span class="truncate">{{ $atividade->titulo }}</span>
                                                    @if ($late)
                                                        <span class="shrink-0 text-red-500" aria-label="Tarefa atrasada">
                                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                                <path d="M12 8v5M12 17h.01M10.3 4.5 2.7 18a1.5 1.5 0 0 0 1.3 2.2h16a1.5 1.5 0 0 0 1.3-2.2L13.7 4.5a1.9 1.9 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    @endif
                                                </p>
                                                <p class="mt-1 truncate text-xs text-slate-500 sm:text-base">{{ $atividade->disciplina->nome }} · {{ $atividade->prazo->timezone('America/Sao_Paulo')->format('d/m H:i') }}</p>
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
                                        <div class="rounded-[18px] bg-white px-5 py-8">
                                            <p class="text-center text-lg text-slate-500">Nenhuma tarefa para hoje! &#127881;</p>
                                        </div>
                                    @endforelse
                                </div>
                            </section>

                            <section id="proximos-compromissos" class="mt-9 lg:mt-10">
                                <h2 class="text-xl font-medium text-slate-950 lg:text-2xl">Próximos Compromissos</h2>
                                <div class="mt-5 grid gap-4 lg:grid-cols-2">
                                    @forelse ($proximosCompromissos as $compromisso)
                                        <article class="rounded-[18px] bg-white p-5">
                                            @if (data_get($compromisso, 'disciplina.nome'))
                                                <p class="text-sm font-medium text-slate-500">{{ data_get($compromisso, 'disciplina.nome') }}</p>
                                            @endif

                                            <p class="mt-2 text-lg font-medium text-slate-950">{{ data_get($compromisso, 'titulo') }}</p>

                                            @if (data_get($compromisso, 'prazo'))
                                                <p class="mt-1 text-sm text-slate-500">{{ data_get($compromisso, 'prazo')->format('d/m/Y H:i') }}</p>
                                            @endif
                                        </article>
                                    @empty
                                        <div class="rounded-[18px] bg-white px-5 py-8 lg:col-span-2">
                                            <p class="text-center text-lg text-slate-500">Nenhum compromisso próximo &#128197;</p>
                                        </div>
                                    @endforelse
                                </div>
                            </section>

                        </div>

                        <aside class="mt-7 lg:mt-0">
                            <section class="hidden lg:block">
                                <div class="mb-5 flex items-center justify-between">
                                    <h2 class="text-2xl font-medium text-slate-950">Tarefas de Hoje</h2>
                                    <button type="button" x-on:click="activeModal = 'atividade-create'" class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-blue-600 text-white shadow-[0_12px_24px_rgba(37,99,235,0.24)]" aria-label="Adicionar atividade">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="space-y-3">
                                    @forelse ($atividadesHoje as $atividade)
                                        @php
                                            $late = (int) data_get($atividade, 'status') === \App\Enums\StatusAtividadeEnum::ATRASADA->value;
                                            $priorityClass = match ((int) data_get($atividade, 'prioridade')) {
                                                3 => 'border-l-red-500',
                                                2 => 'border-l-amber-500',
                                                default => 'border-l-green-500',
                                            };
                                        @endphp

                                        <article class="flex min-h-[80px] w-full max-w-full items-center gap-4 overflow-hidden rounded-[18px] border-l-2 {{ $priorityClass }} bg-white px-5 py-4">
                                            <form method="POST" action="{{ route('atividades.concluir', $atividade) }}" class="shrink-0">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-slate-300 text-transparent hover:border-blue-600" aria-label="Marcar como concluída">
                                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                        <path d="m6 12 4 4 8-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <button type="button" x-on:click="activeModal = 'atividade-edit-{{ $atividade->id }}'" class="min-w-0 flex-1 text-left">
                                                <p class="flex min-w-0 items-center gap-2 text-lg font-medium text-slate-950">
                                                    <span class="truncate">{{ $atividade->titulo }}</span>
                                                    @if ($late)
                                                        <span class="shrink-0 text-red-500" aria-label="Tarefa atrasada">
                                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                                <path d="M12 8v5M12 17h.01M10.3 4.5 2.7 18a1.5 1.5 0 0 0 1.3 2.2h16a1.5 1.5 0 0 0 1.3-2.2L13.7 4.5a1.9 1.9 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    @endif
                                                </p>
                                                <p class="mt-1 truncate text-base text-slate-500">{{ $atividade->disciplina->nome }} · {{ $atividade->prazo->timezone('America/Sao_Paulo')->format('d/m H:i') }}</p>
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
                                        <div class="rounded-[18px] bg-white px-5 py-8">
                                            <p class="text-center text-lg text-slate-500">Nenhuma tarefa para hoje! &#127881;</p>
                                        </div>
                                    @endforelse
                                </div>
                            </section>

                            <section class="mt-7 lg:mt-8">
                                <h2 class="text-xl font-medium text-slate-950 lg:text-2xl">Lembretes</h2>

                                <div class="mt-5 space-y-3">
                                    @forelse ($lembretes as $lembrete)
                                        <article class="flex min-h-[68px] items-center gap-4 rounded-[14px] bg-white px-4 lg:min-h-[76px]">
                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-[10px] bg-blue-50 text-blue-600">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                    <circle cx="12" cy="12" r="8.5" stroke="currentColor" stroke-width="1.8" />
                                                    <path d="M12 7.5V12l3 2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>

                                            <div class="min-w-0">
                                                <p class="truncate text-base text-slate-950">{{ data_get($lembrete, 'titulo') }}</p>
                                                @if (data_get($lembrete, 'data'))
                                                    <p class="mt-1 truncate text-sm text-slate-500">{{ data_get($lembrete, 'data') }}</p>
                                                @endif
                                            </div>
                                        </article>
                                    @empty
                                        <div class="rounded-[18px] bg-white px-5 py-8">
                                            <p class="text-center text-lg text-slate-500">Nenhum lembrete por enquanto! &#128276;</p>
                                        </div>
                                    @endforelse
                                </div>
                            </section>
                        </aside>
                    </div>
                </div>

                @include('partials.mobile-bottom-nav', [
                    'active' => 'dashboard',
                    'createClick' => "activeModal = 'atividade-create'",
                    'createLabel' => 'Adicionar atividade',
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

                @foreach ($atividadesHoje as $atividade)
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
