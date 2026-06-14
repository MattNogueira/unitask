<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme') === 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Outros</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-950 antialiased">
        <main class="min-h-screen bg-white lg:flex">
            @include('partials.app-sidebar', ['active' => 'menu'])

            <div class="mx-auto flex min-h-screen w-full max-w-[540px] flex-col px-7 pb-28 pt-11 lg:hidden">
                <header class="flex items-center justify-between">
                    <a href="{{ route('dashboard') }}" class="flex min-w-0 items-center gap-4">
                        <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-[16px] bg-blue-600 text-white shadow-[0_18px_38px_rgba(37,99,235,0.22)]">
                            <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M22 10.5 12 5 2 10.5 12 16l10-5.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6 12.7v4.2c0 1.2 2.7 2.6 6 2.6s6-1.4 6-2.6v-4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>

                        <span class="min-w-0">
                            <span class="block truncate text-3xl font-medium leading-tight">UniTask</span>
                            <span class="block truncate text-lg text-slate-500">Organização aca...</span>
                        </span>
                    </a>
                </header>

                <section class="mt-16">
                    <p class="px-8 text-sm font-medium uppercase text-slate-400">Cadastro</p>

                    <a href="{{ route('disciplinas.index') }}" class="mt-4 flex h-[68px] items-center gap-5 rounded-[16px] bg-slate-50 px-8 text-xl font-medium text-slate-500 hover:bg-blue-50 hover:text-blue-600">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 5.5A2.5 2.5 0 0 1 7.5 3H19v16H7.5A2.5 2.5 0 0 0 5 21.5v-16Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                            <path d="M5 18.5A2.5 2.5 0 0 1 7.5 16H19" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                        Gerir disciplinas
                    </a>
                </section>

                @include('partials.mobile-bottom-nav', [
                    'active' => 'menu',
                    'createHref' => route('atividades.index', ['modal' => 'create']),
                    'createLabel' => 'Adicionar tarefa',
                ])
            </div>

            <div class="hidden min-h-screen flex-1 bg-slate-100 lg:block"></div>
        </main>
    </body>
</html>
