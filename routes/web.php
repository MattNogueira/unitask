<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\DisciplinaController;
use App\Models\Atividade;
use App\Models\Disciplina;
use App\Enums\StatusAtividadeEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $timezone = 'America/Sao_Paulo';
    $today = now($timezone);

    $disciplinas = Disciplina::query()
        ->where('id_usuario', $user->id)
        ->orderBy('nome')
        ->get();

    $atividades = Atividade::query()
        ->with('disciplina')
        ->whereIn('id_disciplina', $disciplinas->pluck('id'))
        ->orderBy('prazo')
        ->get();

    return view('dashboard', [
        'atividadesHoje' => $atividades
            ->where('status', '!=', StatusAtividadeEnum::CONCLUIDA->value)
            ->filter(fn ($atividade) => $atividade->prazo->copy()->timezone($timezone)->isSameDay($today))
            ->values(),
        'proximosCompromissos' => $atividades
            ->filter(fn ($atividade) => $atividade->prazo->copy()->timezone($timezone)->isFuture())
            ->take(4)
            ->values(),
        'lembretes' => collect(),
        'disciplinas' => $disciplinas,
        'usuario' => $user,
    ]);
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/menu', function () {
        return view('menu');
    })->name('menu');

    Route::resource('disciplinas', DisciplinaController::class)->except(['show']);
    Route::patch('atividades/{atividade}/concluir', [AtividadeController::class, 'concluir'])
        ->name('atividades.concluir');
    Route::resource('atividades', AtividadeController::class)->except(['show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
