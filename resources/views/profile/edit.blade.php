<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme') === 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Perfil | UniTask</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="overflow-x-hidden font-sans text-slate-950 antialiased dark:bg-slate-950 dark:text-slate-50">
        <main class="min-h-screen bg-slate-100 dark:bg-slate-950 lg:flex">
            @include('partials.app-sidebar', ['active' => 'perfil'])

            <div class="mx-auto flex min-h-screen w-full max-w-[540px] flex-col bg-slate-100 pb-28 lg:mx-0 lg:max-w-none lg:flex-1 lg:pb-0 dark:bg-slate-950">
                <header class="bg-white px-5 pb-8 pt-14 lg:border-b lg:border-slate-200 lg:px-10 lg:pt-8 dark:bg-slate-900 dark:lg:border-slate-800">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard') }}" class="flex h-11 w-11 items-center justify-center rounded-[14px] bg-slate-100 text-slate-950 dark:bg-slate-800 dark:text-slate-50" aria-label="Voltar ao dashboard">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M15 6 9 12l6 6M10 12h10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <h1 class="text-2xl font-medium lg:text-3xl">Perfil</h1>
                    </div>

                    <section class="mt-8 flex flex-col items-center text-center">
                        <div class="flex h-28 w-28 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-950 dark:text-blue-300">
                            <svg class="h-14 w-14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 12a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4Z" stroke="currentColor" stroke-width="1.8" />
                                <path d="M6.8 19.2v-1.1c0-2.1 1.7-3.8 3.8-3.8h2.8c2.1 0 3.8 1.7 3.8 3.8v1.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                        </div>

                        <h2 class="mt-5 text-3xl font-medium leading-tight">{{ $user->nome }}</h2>
                        <p class="mt-1 text-lg text-slate-500 dark:text-slate-400">{{ $user->email }}</p>
                    </section>
                </header>

                <div class="flex-1 px-5 py-5 lg:px-10">
                    <a href="{{ route('profile.manage') }}" class="flex min-h-[72px] items-center justify-between rounded-[18px] bg-white px-5 text-lg font-medium text-slate-950 shadow-sm transition hover:bg-blue-50 hover:text-blue-600 dark:bg-slate-900 dark:text-slate-50 dark:hover:bg-slate-800">
                        <span class="flex items-center gap-4">
                            <svg class="h-7 w-7 text-slate-500 dark:text-slate-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 12a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4Z" stroke="currentColor" stroke-width="1.8" />
                                <path d="M6.8 19.2v-1.1c0-2.1 1.7-3.8 3.8-3.8h2.8c2.1 0 3.8 1.7 3.8 3.8v1.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                            </svg>
                            Gerenciar perfil
                        </span>
                        <svg class="h-5 w-5 text-slate-300" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.22 14.78a.75.75 0 0 1 0-1.06L10.94 10 7.22 6.28a.75.75 0 0 1 1.06-1.06l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0Z" clip-rule="evenodd" />
                        </svg>
                    </a>

                    <h2 class="mt-7 px-1 text-sm font-medium uppercase tracking-wide text-slate-500 dark:text-slate-400">Configurações</h2>

                    <section class="mt-3 overflow-hidden rounded-[18px] bg-white shadow-sm dark:bg-slate-900">
                        <button type="button" class="flex min-h-[68px] w-full items-center justify-between px-5 text-left text-lg font-medium text-slate-950 dark:text-slate-50">
                            <span class="flex items-center gap-4">
                                <svg class="h-7 w-7 text-slate-500 dark:text-slate-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M18 16v-5a6 6 0 1 0-12 0v5l-1.5 2h15L18 16Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                    <path d="M10 20h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                                Notificações
                            </span>
                            <svg class="h-5 w-5 text-slate-300" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.22 14.78a.75.75 0 0 1 0-1.06L10.94 10 7.22 6.28a.75.75 0 0 1 1.06-1.06l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0Z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div class="mx-5 border-t border-slate-100 dark:border-slate-800"></div>

                        <form method="POST" action="{{ route('theme.update') }}" x-data="{ dark: {{ session('theme') === 'dark' ? 'true' : 'false' }} }" x-ref="themeForm" class="flex min-h-[68px] items-center justify-between px-5 text-lg font-medium text-slate-950 dark:text-slate-50">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="theme" x-bind:value="dark ? 'dark' : 'light'">

                            <span class="flex items-center gap-4">
                                <svg class="h-7 w-7 text-slate-500 dark:text-slate-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M20 15.5A8.5 8.5 0 0 1 8.5 4 7 7 0 1 0 20 15.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                </svg>
                                Tema escuro
                            </span>

                            <label class="relative h-8 w-14 cursor-pointer rounded-full transition" x-bind:class="dark ? 'bg-blue-600' : 'bg-slate-200'" aria-label="Alternar tema escuro">
                                <input type="checkbox" class="sr-only" x-model="dark" x-on:change="$nextTick(() => $refs.themeForm.submit())">
                                <span class="absolute left-1 top-1 h-6 w-6 rounded-full bg-white shadow-sm transition" x-bind:class="{ 'translate-x-6': dark }"></span>
                            </label>
                        </form>
                    </section>

                    <form method="POST" action="{{ route('logout') }}" class="mt-5 lg:hidden">
                        @csrf
                        <button type="submit" class="flex h-[60px] w-full items-center justify-center gap-3 rounded-[18px] bg-red-50 text-lg font-medium text-red-500 transition hover:bg-red-100 dark:bg-red-950/40 dark:text-red-300 dark:hover:bg-red-950">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M10 6H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h4M15 8l4 4-4 4M19 12H9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Sair da Conta
                        </button>
                    </form>
                </div>

                @include('partials.mobile-bottom-nav', [
                    'active' => '',
                    'createHref' => route('atividades.index', ['modal' => 'create']),
                    'createLabel' => 'Adicionar tarefa',
                ])
            </div>
        </main>
    </body>
</html>
