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
    <body class="font-sans text-slate-950 antialiased">
        @php
            $today = now();
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

        <main class="min-h-screen bg-slate-100 lg:flex" x-data="{ createModal: null }">
            <aside class="hidden min-h-screen w-[280px] shrink-0 flex-col border-r border-slate-200 bg-white px-6 py-8 lg:flex">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <span class="flex h-12 w-12 items-center justify-center rounded-[14px] bg-blue-600 text-white shadow-[0_12px_24px_rgba(37,99,235,0.22)]">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M22 10.5 12 5 2 10.5 12 16l10-5.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6 12.7v4.2c0 1.2 2.7 2.6 6 2.6s6-1.4 6-2.6v-4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <span>
                        <span class="block text-2xl font-medium leading-tight text-slate-950">UniTask</span>
                        <span class="block text-sm text-slate-500">Organização acadêmica</span>
                    </span>
                </a>

                <nav class="mt-12 space-y-2" aria-label="Navegacao principal">
                    <a href="{{ route('dashboard') }}" class="flex h-12 items-center gap-3 rounded-[14px] bg-blue-50 px-4 font-medium text-blue-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="m4 10 8-6 8 6v9a1 1 0 0 1-1 1h-4.5v-5.5h-5V20H5a1 1 0 0 1-1-1v-9Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                        </svg>
                        Inicio
                    </a>

                    <a href="#" class="flex h-12 items-center gap-3 rounded-[14px] px-4 font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-700">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="m5 7 1.5 1.5L9.5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 7h7M12 13h7M5 13h4M5 18h4M12 18h7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                        Tarefas
                    </a>

                    <a href="#" class="flex h-12 items-center gap-3 rounded-[14px] px-4 font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-700">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M7 4v3M17 4v3M5 9h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            <rect x="4" y="6" width="16" height="14" rx="2" stroke="currentColor" stroke-width="1.8" />
                        </svg>
                        Calendário
                    </a>

                    <a href="#disciplinas" class="flex h-12 items-center gap-3 rounded-[14px] px-4 font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-700">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 5.5A2.5 2.5 0 0 1 7.5 3H19v16H7.5A2.5 2.5 0 0 0 5 21.5v-16Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                            <path d="M5 18.5A2.5 2.5 0 0 1 7.5 16H19" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                        Disciplinas
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex h-12 items-center gap-3 rounded-[14px] px-4 font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-700">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 12a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4Z" stroke="currentColor" stroke-width="1.8" />
                            <path d="M6.8 19.2v-1.1c0-2.1 1.7-3.8 3.8-3.8h2.8c2.1 0 3.8 1.7 3.8 3.8v1.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                        Perfil
                    </a>
                </nav>

                <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                    @csrf
                    <button type="submit" class="flex h-12 w-full items-center gap-3 rounded-[14px] px-4 font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-700">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M10 6H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h4M15 8l4 4-4 4M19 12H9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Sair
                    </button>
                </form>
            </aside>

            <div class="mx-auto flex min-h-screen w-full max-w-[540px] flex-col bg-slate-100 shadow-[0_0_80px_rgba(15,23,42,0.08)] lg:mx-0 lg:max-w-none lg:flex-1 lg:shadow-none">
                <header class="bg-white px-7 pb-7 pt-16 lg:border-b lg:border-slate-200 lg:px-10 lg:pb-8 lg:pt-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-base text-slate-500">Bem-vindo(a) de volta!</p>
                            <h1 class="mt-1 text-[26px] font-medium leading-tight text-slate-950 lg:text-4xl">{{ auth()->user()->nome }}</h1>
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="button" x-on:click="createModal = 'atividade'" class="hidden h-12 items-center gap-2 rounded-[14px] bg-blue-600 px-5 font-medium text-white shadow-[0_12px_24px_rgba(37,99,235,0.22)] lg:flex">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                                Nova tarefa
                            </button>

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

                            <section id="tarefas-hoje" class="mt-9 lg:mt-10">
                                <div class="mb-5 flex items-center justify-between">
                                    <h2 class="text-xl font-medium text-slate-950 lg:text-2xl">Tarefas de Hoje</h2>
                                    <button type="button" x-on:click="createModal = 'atividade'" class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-blue-600 text-white shadow-[0_12px_24px_rgba(37,99,235,0.24)] lg:hidden" aria-label="Adicionar atividade">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="grid gap-4 lg:grid-cols-2">
                                    @forelse ($atividadesHoje as $atividade)
                                        <article class="flex items-center justify-between gap-4 rounded-[14px] border border-slate-100 px-4 py-3">
                                            <div class="min-w-0">
                                                <p class="truncate text-base font-medium text-slate-950">{{ data_get($atividade, 'titulo') }}</p>
                                                @if (data_get($atividade, 'descricao'))
                                                    <p class="mt-1 truncate text-sm text-slate-500">{{ data_get($atividade, 'descricao') }}</p>
                                                @endif
                                            </div>

                                            @if (data_get($atividade, 'prazo'))
                                                <span class="shrink-0 text-sm font-medium text-slate-500">{{ data_get($atividade, 'prazo')->format('H:i') }}</span>
                                            @endif
                                        </article>
                                    @empty
                                        <div class="rounded-[18px] bg-white px-5 py-8 lg:col-span-2">
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

                            <section id="disciplinas" class="mt-9 lg:mt-10">
                                <div class="mb-5 flex items-center justify-between">
                                    <h2 class="text-xl font-medium text-slate-950 lg:text-2xl">Minhas Disciplinas</h2>
                                    <button type="button" x-on:click="createModal = 'disciplina'" class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-blue-600 text-white shadow-[0_12px_24px_rgba(37,99,235,0.24)]" aria-label="Adicionar disciplina">
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="grid gap-4 lg:grid-cols-2">
                                    @forelse ($disciplinas as $disciplina)
                                        <article class="rounded-[18px] bg-white p-5">
                                            <p class="text-lg font-medium text-slate-950">{{ data_get($disciplina, 'nome') }}</p>
                                            @if (data_get($disciplina, 'professor'))
                                                <p class="mt-1 text-sm text-slate-500">{{ data_get($disciplina, 'professor') }}</p>
                                            @endif
                                        </article>
                                    @empty
                                        <div class="rounded-[18px] bg-white px-5 py-8 lg:col-span-2">
                                            <p class="text-center text-lg text-slate-500">Nenhuma disciplina cadastrada... &#128218;</p>
                                        </div>
                                    @endforelse
                                </div>
                            </section>
                        </div>

                        <aside class="mt-7 lg:mt-0">
                            <section class="hidden rounded-[22px] bg-white p-6 lg:block">
                                <div class="flex items-center gap-4">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M12 12a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4Z" stroke="currentColor" stroke-width="1.8" />
                                            <path d="M6.8 19.2v-1.1c0-2.1 1.7-3.8 3.8-3.8h2.8c2.1 0 3.8 1.7 3.8 3.8v1.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="truncate text-lg font-medium text-slate-950">{{ auth()->user()->nome }}</p>
                                        <p class="truncate text-sm text-slate-500">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                            </section>

                            <section class="lg:mt-6">
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

                <nav class="fixed inset-x-0 bottom-0 mx-auto h-[74px] w-full max-w-[540px] bg-white px-10 shadow-[0_-16px_35px_rgba(15,23,42,0.04)] lg:hidden" aria-label="Navegacao principal">
                    <div class="relative flex h-full items-center justify-between">
                        <a href="{{ route('dashboard') }}" class="text-blue-600" aria-label="Inicio">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="m4 10 8-6 8 6v9a1 1 0 0 1-1 1h-4.5v-5.5h-5V20H5a1 1 0 0 1-1-1v-9Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <a href="#" class="text-slate-500" aria-label="Tarefas">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="m5 7 1.5 1.5L9.5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 7h7M12 13h7M5 13h4M5 18h4M12 18h7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </a>

                        <button type="button" x-on:click="createModal = 'atividade'" class="absolute left-1/2 top-[-14px] flex h-[60px] w-[60px] -translate-x-1/2 items-center justify-center rounded-[18px] bg-blue-600 text-white shadow-[0_16px_30px_rgba(37,99,235,0.32)]" aria-label="Adicionar atividade">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </button>

                        <a href="#" class="text-slate-500" aria-label="Calendario">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M7 4v3M17 4v3M5 9h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                <rect x="4" y="6" width="16" height="14" rx="2" stroke="currentColor" stroke-width="1.8" />
                            </svg>
                        </a>

                        <a href="{{ route('profile.edit') }}" class="text-slate-500" aria-label="Perfil">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 12a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4Z" stroke="currentColor" stroke-width="1.8" />
                                <path d="M6.8 19.2v-1.1c0-2.1 1.7-3.8 3.8-3.8h2.8c2.1 0 3.8 1.7 3.8 3.8v1.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </a>
                    </div>
                </nav>
            </div>

            <div x-cloak x-show="createModal" class="fixed inset-0 z-50 flex items-end justify-center lg:items-center" aria-modal="true" role="dialog">
                <button type="button" x-on:click="createModal = null" class="absolute inset-0 bg-slate-950/40 backdrop-blur-sm" aria-label="Fechar modal"></button>

                <section x-show="createModal === 'atividade'" x-transition class="relative w-full max-w-[540px] rounded-t-[28px] bg-white px-6 pb-8 pt-6 shadow-[0_-24px_60px_rgba(15,23,42,0.22)] lg:max-w-[520px] lg:rounded-[28px]">
                    <div class="mx-auto mb-7 h-1 w-12 rounded-full bg-slate-200"></div>
                    <h2 class="text-2xl font-medium text-slate-950">Nova Tarefa</h2>

                    <form class="mt-8 space-y-5">
                        <div>
                            <label for="atividade_titulo" class="block text-sm font-medium uppercase text-slate-500">Nome da tarefa</label>
                            <input id="atividade_titulo" name="titulo" type="text" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="Ex: Entregar relatório">
                        </div>

                        <div>
                            <label for="atividade_disciplina" class="block text-sm font-medium uppercase text-slate-500">Disciplina</label>
                            <select id="atividade_disciplina" name="id_disciplina" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20">
                                @forelse ($disciplinas as $disciplina)
                                    <option value="{{ $disciplina->id }}">{{ $disciplina->nome }}</option>
                                @empty
                                    <option value="">Cadastre uma disciplina primeiro</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="atividade_prazo" class="block text-sm font-medium uppercase text-slate-500">Data de entrega</label>
                                <input id="atividade_prazo" name="prazo" type="date" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20">
                            </div>

                            <div>
                                <label for="atividade_prioridade" class="block text-sm font-medium uppercase text-slate-500">Prioridade</label>
                                <select id="atividade_prioridade" name="prioridade" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20">
                                    <option value="1">Baixa</option>
                                    <option value="2" selected>Média</option>
                                    <option value="3">Alta</option>
                                </select>
                            </div>
                        </div>

                        <button type="button" class="h-[60px] w-full rounded-[14px] bg-blue-600 text-lg font-semibold text-white shadow-[0_18px_34px_rgba(37,99,235,0.26)] transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
                            Salvar Tarefa
                        </button>
                    </form>
                </section>

                <section x-show="createModal === 'disciplina'" x-transition class="relative w-full max-w-[540px] rounded-t-[28px] bg-white px-6 pb-8 pt-6 shadow-[0_-24px_60px_rgba(15,23,42,0.22)] lg:max-w-[520px] lg:rounded-[28px]">
                    <div class="mx-auto mb-7 h-1 w-12 rounded-full bg-slate-200"></div>
                    <h2 class="text-2xl font-medium text-slate-950">Nova Disciplina</h2>

                    <form class="mt-8 space-y-5">
                        <div>
                            <label for="disciplina_nome" class="block text-sm font-medium uppercase text-slate-500">Nome da disciplina</label>
                            <input id="disciplina_nome" name="nome" type="text" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="Ex: Algoritmos">
                        </div>

                        <div>
                            <label for="disciplina_professor" class="block text-sm font-medium uppercase text-slate-500">Professor</label>
                            <input id="disciplina_professor" name="professor" type="text" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20" placeholder="Ex: Ana Souza">
                        </div>

                        <div>
                            <label for="disciplina_horario" class="block text-sm font-medium uppercase text-slate-500">Horário</label>
                            <input id="disciplina_horario" name="horario" type="datetime-local" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20">
                        </div>

                        <button type="button" class="h-[60px] w-full rounded-[14px] bg-blue-600 text-lg font-semibold text-white shadow-[0_18px_34px_rgba(37,99,235,0.26)] transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
                            Salvar Disciplina
                        </button>
                    </form>
                </section>
            </div>
        </main>
    </body>
</html>
