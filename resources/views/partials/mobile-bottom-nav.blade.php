@props([
    'active' => 'dashboard',
    'createHref' => null,
    'createClick' => null,
    'createLabel' => 'Adicionar',
])

<nav class="fixed inset-x-0 bottom-0 z-30 mx-auto h-[82px] w-full max-w-[540px] bg-white px-4 shadow-[0_-16px_35px_rgba(15,23,42,0.06)] dark:bg-slate-900 dark:shadow-[0_-16px_35px_rgba(0,0,0,0.24)] lg:hidden" aria-label="Navegação principal">
    <div class="grid h-full grid-cols-5 items-center">
        <a href="{{ route('dashboard') }}" class="{{ $active === 'dashboard' ? 'text-blue-600' : 'text-slate-500' }} flex min-w-0 flex-col items-center justify-center gap-1 text-[11px] font-medium" aria-label="Home">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="m4 10 8-6 8 6v9a1 1 0 0 1-1 1h-4.5v-5.5h-5V20H5a1 1 0 0 1-1-1v-9Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
            </svg>
            <span class="leading-none">Home</span>
        </a>

        <a href="{{ route('atividades.index') }}" class="{{ $active === 'atividades' ? 'text-blue-600' : 'text-slate-500' }} flex min-w-0 flex-col items-center justify-center gap-1 text-[11px] font-medium" aria-label="Tarefas">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="m5 7 1.5 1.5L9.5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 7h7M12 13h7M5 13h4M5 18h4M12 18h7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
            </svg>
            <span class="leading-none">Tarefas</span>
        </a>

        <div class="flex min-w-0 justify-center">
            @if ($createHref)
                <a href="{{ $createHref }}" class="-mt-5 flex h-[58px] w-[58px] items-center justify-center rounded-[16px] bg-blue-600 text-white shadow-[0_16px_30px_rgba(37,99,235,0.32)]" aria-label="{{ $createLabel }}">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </a>
            @else
                <button type="button" x-on:click="{{ $createClick }}" class="-mt-5 flex h-[58px] w-[58px] items-center justify-center rounded-[16px] bg-blue-600 text-white shadow-[0_16px_30px_rgba(37,99,235,0.32)]" aria-label="{{ $createLabel }}">
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            @endif
        </div>

        <a href="#" class="flex min-w-0 flex-col items-center justify-center gap-1 text-[11px] font-medium text-slate-500" aria-label="Agenda">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M7 4v3M17 4v3M5 9h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                <rect x="4" y="6" width="16" height="14" rx="2" stroke="currentColor" stroke-width="1.8" />
            </svg>
            <span class="leading-none">Agenda</span>
        </a>

        <a href="{{ route('menu') }}" class="{{ $active === 'menu' ? 'text-blue-600' : 'text-slate-500' }} flex min-w-0 flex-col items-center justify-center gap-1 text-[11px] font-medium" aria-label="Outros">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M5 7h14M5 12h14M5 17h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
            <span class="leading-none">Outros</span>
        </a>
    </div>
</nav>
