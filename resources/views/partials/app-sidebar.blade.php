@props(['active' => 'dashboard'])

@php
    $additionalSidebarOptions = [];
@endphp

<aside x-data="{ outrosOpen: false }" class="hidden min-h-screen w-[280px] shrink-0 flex-col border-r border-slate-200 bg-white px-6 py-8 lg:flex">
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="flex min-w-0 items-center gap-3">
            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-[14px] bg-blue-600 text-white shadow-[0_12px_24px_rgba(37,99,235,0.22)]">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M22 10.5 12 5 2 10.5 12 16l10-5.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 12.7v4.2c0 1.2 2.7 2.6 6 2.6s6-1.4 6-2.6v-4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <span class="min-w-0">
                <span class="block truncate text-2xl font-medium leading-tight text-slate-950">UniTask</span>
                <span class="block truncate text-sm text-slate-500">Organização acadêmica</span>
            </span>
        </a>

    </div>

    <nav class="mt-12 space-y-2" aria-label="Navegação principal">
        <a href="{{ route('dashboard') }}" class="{{ $active === 'dashboard' ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} flex h-12 items-center gap-3 rounded-[14px] px-4 font-medium">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="m4 10 8-6 8 6v9a1 1 0 0 1-1 1h-4.5v-5.5h-5V20H5a1 1 0 0 1-1-1v-9Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
            </svg>
            Início
        </a>

        <a href="{{ route('atividades.index') }}" class="{{ $active === 'atividades' ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} flex h-12 items-center gap-3 rounded-[14px] px-4 font-medium">
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

        <a href="{{ route('disciplinas.index') }}" class="{{ $active === 'disciplinas' ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} flex h-12 items-center gap-3 rounded-[14px] px-4 font-medium">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M5 5.5A2.5 2.5 0 0 1 7.5 3H19v16H7.5A2.5 2.5 0 0 0 5 21.5v-16Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                <path d="M5 18.5A2.5 2.5 0 0 1 7.5 16H19" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
            </svg>
            Disciplinas
        </a>

        <a href="{{ route('profile.edit') }}" class="{{ $active === 'perfil' ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} flex h-12 items-center gap-3 rounded-[14px] px-4 font-medium">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 12a3.2 3.2 0 1 0 0-6.4 3.2 3.2 0 0 0 0 6.4Z" stroke="currentColor" stroke-width="1.8" />
                <path d="M6.8 19.2v-1.1c0-2.1 1.7-3.8 3.8-3.8h2.8c2.1 0 3.8 1.7 3.8 3.8v1.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
            </svg>
            Perfil
        </a>

        @if (count($additionalSidebarOptions) > 0)
            <div class="relative">
                <button type="button" x-on:click="outrosOpen = ! outrosOpen" class="{{ $active === 'menu' ? 'bg-blue-50 text-blue-600' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700' }} flex h-12 w-full items-center gap-3 rounded-[14px] px-4 font-medium">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M5 7h14M5 12h14M5 17h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <span class="flex-1 text-left">Outros</span>
                    <svg class="h-4 w-4 transition" x-bind:class="{ 'rotate-180': outrosOpen }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.17l3.71-3.94a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="outrosOpen" x-transition x-on:click.outside="outrosOpen = false" class="absolute left-0 right-0 top-14 z-20 rounded-[14px] border border-slate-100 bg-white p-2 shadow-[0_18px_34px_rgba(15,23,42,0.14)]">
                    @foreach ($additionalSidebarOptions as $option)
                        <a href="{{ $option['href'] }}" class="flex rounded-[10px] px-3 py-2 text-sm font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-700">{{ $option['label'] }}</a>
                    @endforeach
                </div>
            </div>
        @endif
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
