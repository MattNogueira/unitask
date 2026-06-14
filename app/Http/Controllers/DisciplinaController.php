<?php

namespace App\Http\Controllers;

use App\Http\Requests\Disciplina\StoreDisciplinaRequest;
use App\Http\Requests\Disciplina\UpdateDisciplinaRequest;
use App\Models\Disciplina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DisciplinaController extends Controller
{
    public function index(Request $request): View
    {
        return view('disciplinas.index', [
            'disciplinas' => Disciplina::query()
                ->where('id_usuario', $request->user()->id)
                ->orderBy('nome')
                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('disciplinas.create');
    }

    public function store(StoreDisciplinaRequest $request): RedirectResponse
    {
        $request->user()->disciplinas()->create($request->validated());

        if ($request->input('redirect_to') === 'dashboard') {
            return redirect()
                ->route('dashboard')
                ->with('status', 'disciplina-criada');
        }

        return redirect()
            ->to(url()->previous())
            ->with('status', 'disciplina-criada');
    }

    public function edit(Request $request, Disciplina $disciplina): View
    {
        $this->authorizeDisciplina($request, $disciplina);

        return view('disciplinas.edit', [
            'disciplina' => $disciplina,
        ]);
    }

    public function update(UpdateDisciplinaRequest $request, Disciplina $disciplina): RedirectResponse
    {
        $this->authorizeDisciplina($request, $disciplina);

        $disciplina->update($request->validated());

        return redirect()
            ->to(url()->previous())
            ->with('status', 'disciplina-atualizada');
    }

    public function destroy(Request $request, Disciplina $disciplina): RedirectResponse
    {
        $this->authorizeDisciplina($request, $disciplina);

        $disciplina->delete();

        return redirect()
            ->route('disciplinas.index')
            ->with('status', 'disciplina-removida');
    }

    private function authorizeDisciplina(Request $request, Disciplina $disciplina): void
    {
        abort_unless($disciplina->id_usuario === $request->user()->id, 404);
    }
}
