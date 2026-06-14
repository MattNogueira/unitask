<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme') === 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Minhas Disciplinas</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>[x-cloak] { display: none !important; }</style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="overflow-x-hidden font-sans text-slate-950 antialiased">
        <main class="min-h-screen bg-slate-100 lg:flex" x-data="{ activeModal: null }">
            @include('partials.app-sidebar', ['active' => 'disciplinas'])

            <div class="mx-auto flex min-h-screen w-full max-w-[540px] flex-col bg-slate-100 lg:mx-0 lg:max-w-none lg:flex-1">
                <header class="bg-white px-5 pb-5 pt-14 lg:border-b lg:border-slate-200 lg:px-10 lg:pt-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('dashboard') }}" class="flex h-11 w-11 items-center justify-center rounded-[14px] bg-slate-100 text-slate-950" aria-label="Voltar ao dashboard">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M15 6 9 12l6 6M10 12h10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <h1 class="text-2xl font-medium lg:text-3xl">Minhas Disciplinas</h1>
                        </div>

                        <button type="button" x-on:click="activeModal = 'disciplina-create'" class="hidden h-11 items-center gap-2 rounded-[14px] bg-blue-600 px-5 font-medium text-white lg:flex">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            Nova disciplina
                        </button>
                    </div>
                </header>

                <section class="flex-1 px-5 py-5 pb-28 lg:px-10 lg:pb-10">
                    <div class="space-y-3 lg:grid lg:grid-cols-2 lg:gap-4 lg:space-y-0 xl:grid-cols-3">
                        @forelse ($disciplinas as $disciplina)
                            <article class="flex min-h-[92px] items-center justify-between gap-4 rounded-[18px] bg-white px-5 py-4">
                                <button type="button" x-on:click="activeModal = 'disciplina-edit-{{ $disciplina->id }}'" class="min-w-0 flex-1 text-left">
                                    <p class="truncate text-lg font-medium text-slate-950">{{ $disciplina->nome }}</p>
                                    <p class="mt-1 truncate text-base text-slate-500">{{ $disciplina->professor }} · {{ $disciplina->horario->timezone('America/Sao_Paulo')->format('d/m H:i') }}</p>
                                </button>

                                <form method="POST" action="{{ route('disciplinas.destroy', $disciplina) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-slate-300 hover:text-red-500" aria-label="Remover disciplina">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                            <path d="M9 6h6M10 10v7M14 10v7M5 6h14M7 6l1 14h8l1-14M10 6l.7-2h2.6L14 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>
                            </article>
                        @empty
                            <div class="rounded-[18px] bg-white px-5 py-8 lg:col-span-full">
                                <p class="text-center text-lg text-slate-500">Nenhuma disciplina cadastrada 📚</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                @include('partials.mobile-bottom-nav', [
                    'active' => 'menu',
                    'createClick' => "activeModal = 'disciplina-create'",
                    'createLabel' => 'Adicionar disciplina',
                ])
            </div>

            <div x-cloak x-show="activeModal" class="fixed inset-0 z-50 flex items-end justify-center lg:items-center" aria-modal="true" role="dialog">
                <button type="button" x-on:click="activeModal = null" class="absolute inset-0 bg-slate-950/40 backdrop-blur-sm" aria-label="Fechar modal"></button>

                @include('disciplinas.partials.modal', [
                    'id' => 'disciplina-create',
                    'title' => 'Nova Disciplina',
                    'action' => route('disciplinas.store'),
                    'submitLabel' => 'Salvar Disciplina',
                ])

                @foreach ($disciplinas as $disciplina)
                    @include('disciplinas.partials.modal', [
                        'id' => 'disciplina-edit-' . $disciplina->id,
                        'title' => 'Editar Disciplina',
                        'action' => route('disciplinas.update', $disciplina),
                        'method' => 'PUT',
                        'submitLabel' => 'Salvar Alterações',
                        'disciplina' => $disciplina,
                    ])
                @endforeach
            </div>
        </main>
    </body>
</html>
