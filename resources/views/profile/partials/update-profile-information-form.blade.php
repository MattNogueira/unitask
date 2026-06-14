<section>
    <header>
        <h2 class="text-xl font-medium text-slate-950 dark:text-slate-50">Informações do usuário</h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Atualize seu nome e e-mail de acesso.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')
        <input type="hidden" name="redirect_to" value="manage">

        <div>
            <label for="nome" class="block text-sm font-medium uppercase text-slate-500 dark:text-slate-400">Nome</label>
            <input id="nome" name="nome" type="text" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-50" value="{{ old('nome', $user->nome) }}" required autocomplete="name">
            <x-input-error class="mt-2" :messages="$errors->get('nome')" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium uppercase text-slate-500 dark:text-slate-400">E-mail</label>
            <input id="email" name="email" type="email" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-50" value="{{ old('email', $user->email) }}" required autocomplete="username">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="h-[54px] rounded-[14px] bg-blue-600 px-6 text-base font-semibold text-white shadow-[0_14px_28px_rgba(37,99,235,0.24)] transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
                Salvar informações
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2200)"
                    class="text-sm font-medium text-slate-500 dark:text-slate-400"
                >Salvo.</p>
            @endif
        </div>
    </form>
</section>
