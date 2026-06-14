<section>
    <header>
        <h2 class="text-xl font-medium text-slate-950 dark:text-slate-50">Atualizar senha</h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Use uma senha segura para proteger sua conta.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium uppercase text-slate-500 dark:text-slate-400">Senha atual</label>
            <input id="update_password_current_password" name="current_password" type="password" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-50" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_senha" class="block text-sm font-medium uppercase text-slate-500 dark:text-slate-400">Nova senha</label>
            <input id="update_password_senha" name="senha" type="password" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-50" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('senha')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_senha_confirmation" class="block text-sm font-medium uppercase text-slate-500 dark:text-slate-400">Confirmar senha</label>
            <input id="update_password_senha_confirmation" name="senha_confirmation" type="password" class="mt-2 h-14 w-full rounded-[14px] border border-slate-200 bg-slate-50 px-5 text-lg text-slate-950 placeholder:text-slate-400 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-50" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('senha_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="h-[54px] rounded-[14px] bg-blue-600 px-6 text-base font-semibold text-white shadow-[0_14px_28px_rgba(37,99,235,0.24)] transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
                Salvar senha
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2200)"
                    class="text-sm font-medium text-slate-500 dark:text-slate-400"
                >Senha atualizada.</p>
            @endif
        </div>
    </form>
</section>
