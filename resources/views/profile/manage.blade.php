<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme') === 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Gerenciar perfil | UniTask</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="overflow-x-hidden font-sans text-slate-950 antialiased dark:bg-slate-950 dark:text-slate-50">
        <main class="min-h-screen bg-slate-100 dark:bg-slate-950 lg:flex">
            @include('partials.app-sidebar', ['active' => 'perfil'])

            <div class="mx-auto flex min-h-screen w-full max-w-[540px] flex-col bg-slate-100 pb-28 lg:mx-0 lg:max-w-none lg:flex-1 lg:pb-10 dark:bg-slate-950">
                <header class="bg-white px-5 pb-5 pt-14 lg:border-b lg:border-slate-200 lg:px-10 lg:pt-8 dark:bg-slate-900 dark:lg:border-slate-800">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('profile.edit') }}" class="flex h-11 w-11 items-center justify-center rounded-[14px] bg-slate-100 text-slate-950 dark:bg-slate-800 dark:text-slate-50" aria-label="Voltar ao perfil">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M15 6 9 12l6 6M10 12h10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                        <h1 class="text-2xl font-medium lg:text-3xl">Gerenciar perfil</h1>
                    </div>
                </header>

                <div class="flex-1 space-y-5 px-5 py-5 lg:grid lg:grid-cols-2 lg:gap-5 lg:space-y-0 lg:px-10">
                    <section class="rounded-[18px] bg-white p-5 shadow-sm dark:bg-slate-900">
                        @include('profile.partials.update-profile-information-form')
                    </section>

                    <section class="rounded-[18px] bg-white p-5 shadow-sm dark:bg-slate-900">
                        @include('profile.partials.update-password-form')
                    </section>
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
