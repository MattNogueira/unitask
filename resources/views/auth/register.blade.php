<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Criar conta | UniTask</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-950 antialiased">
        <main class="min-h-screen bg-slate-100">
            <div class="mx-auto flex min-h-screen w-full max-w-[540px] flex-col items-center justify-center bg-slate-50 px-8 py-10 shadow-[0_0_80px_rgba(15,23,42,0.08)]">
                <section class="w-full max-w-[458px]">
                    <div class="mb-10 flex flex-col items-center text-center">
                        <div class="mb-6 flex h-20 w-20 items-center justify-center rounded-[20px] bg-blue-600 text-white shadow-[0_18px_36px_rgba(37,99,235,0.24)]">
                            <svg class="h-11 w-11" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M22 10.5 12 5 2 10.5 12 16l10-5.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6 12.7v4.2c0 1.2 2.7 2.6 6 2.6s6-1.4 6-2.6v-4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M22 10.5v5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        <h1 class="text-[38px] font-medium leading-none text-slate-950">UniTask</h1>
                        <p class="mt-3 text-lg text-slate-500">Crie sua conta acadêmica</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="nome" class="block text-sm font-medium uppercase text-slate-500">Nome</label>
                            <input
                                id="nome"
                                class="mt-2 block h-[58px] w-full rounded-[14px] border border-slate-200 bg-white px-5 text-lg text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                type="text"
                                name="nome"
                                value="{{ old('nome') }}"
                                placeholder="Seu nome"
                                required
                                autofocus
                                autocomplete="name"
                            >
                            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium uppercase text-slate-500">E-mail</label>
                            <input
                                id="email"
                                class="mt-2 block h-[58px] w-full rounded-[14px] border border-slate-200 bg-white px-5 text-lg text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="seu@email.com"
                                required
                                autocomplete="username"
                            >
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="senha" class="block text-sm font-medium uppercase text-slate-500">Senha</label>
                            <input
                                id="senha"
                                class="mt-2 block h-[58px] w-full rounded-[14px] border border-slate-200 bg-white px-5 text-lg text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                type="password"
                                name="senha"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                            >
                            <x-input-error :messages="$errors->get('senha')" class="mt-2" />
                        </div>

                        <div>
                            <label for="senha_confirmation" class="block text-sm font-medium uppercase text-slate-500">Confirmar senha</label>
                            <input
                                id="senha_confirmation"
                                class="mt-2 block h-[58px] w-full rounded-[14px] border border-slate-200 bg-white px-5 text-lg text-slate-900 shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20"
                                type="password"
                                name="senha_confirmation"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                            >
                            <x-input-error :messages="$errors->get('senha_confirmation')" class="mt-2" />
                        </div>

                        <button type="submit" class="flex h-[60px] w-full items-center justify-center rounded-[14px] bg-blue-600 text-lg font-semibold text-white shadow-[0_18px_34px_rgba(37,99,235,0.26)] transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
                            Criar conta
                        </button>
                    </form>

                    <p class="mt-6 text-center text-lg text-slate-500">
                        Já tem conta?
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-700">
                            Entrar
                        </a>
                    </p>
                </section>
            </div>
        </main>
    </body>
</html>
