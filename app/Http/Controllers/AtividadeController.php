<?php

namespace App\Http\Controllers;

use App\Enums\StatusAtividadeEnum;
use App\Http\Requests\Atividade\StoreAtividadeRequest;
use App\Http\Requests\Atividade\UpdateAtividadeRequest;
use App\Models\Atividade;
use App\Models\Disciplina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AtividadeController extends Controller
{
    public function index(Request $request): View
    {
        $disciplinas = $this->disciplinasDoUsuario($request);
        $prioridade = $request->integer('prioridade');
        $status = $request->query('status');

        $atividades = Atividade::query()
            ->with('disciplina')
            ->whereIn('id_disciplina', $disciplinas->pluck('id'))
            ->when(in_array($prioridade, [1, 2, 3], true), fn ($query) => $query->where('prioridade', $prioridade))
            ->when($status === 'sim', fn ($query) => $query->where('status', StatusAtividadeEnum::CONCLUIDA->value))
            ->when($status === 'nao', fn ($query) => $query->where('status', '!=', StatusAtividadeEnum::CONCLUIDA->value))
            ->orderByRaw('CASE WHEN status = ? THEN 1 ELSE 0 END', [StatusAtividadeEnum::CONCLUIDA->value])
            ->orderBy('prazo')
            ->get();

        return view('atividades.index', compact('atividades', 'disciplinas', 'prioridade', 'status'));
    }

    public function create(Request $request): View
    {
        return view('atividades.create', [
            'disciplinas' => $this->disciplinasDoUsuario($request),
        ]);
    }

    public function store(StoreAtividadeRequest $request): RedirectResponse
    {
        Atividade::create($request->validated() + [
            'status' => StatusAtividadeEnum::PENDENTE->value,
        ]);

        return redirect()
            ->to($this->previousUrlWithoutModal())
            ->with('status', 'atividade-criada');
    }

    public function edit(Request $request, Atividade $atividade): View
    {
        $this->authorizeAtividade($request, $atividade);

        return view('atividades.edit', [
            'atividade' => $atividade,
            'disciplinas' => $this->disciplinasDoUsuario($request),
        ]);
    }

    public function update(UpdateAtividadeRequest $request, Atividade $atividade): RedirectResponse
    {
        $this->authorizeAtividade($request, $atividade);

        $atividade->update($request->validated());

        return redirect()
            ->to($this->previousUrlWithoutModal())
            ->with('status', 'atividade-atualizada');
    }

    public function destroy(Request $request, Atividade $atividade): RedirectResponse
    {
        $this->authorizeAtividade($request, $atividade);

        $atividade->delete();

        return redirect()
            ->route('atividades.index')
            ->with('status', 'atividade-removida');
    }

    public function concluir(Request $request, Atividade $atividade): RedirectResponse
    {
        $this->authorizeAtividade($request, $atividade);

        $nextStatus = StatusAtividadeEnum::CONCLUIDA->value;

        if ((int) $atividade->status === StatusAtividadeEnum::CONCLUIDA->value) {
            $nextStatus = $atividade->prazo->copy()->timezone('America/Sao_Paulo')->endOfDay()->isPast()
                ? StatusAtividadeEnum::ATRASADA->value
                : StatusAtividadeEnum::PENDENTE->value;
        }

        $atividade->update([
            'status' => $nextStatus,
        ]);

        return back()->with('status', 'atividade-status-atualizado');
    }

    private function disciplinasDoUsuario(Request $request)
    {
        return Disciplina::query()
            ->where('id_usuario', $request->user()->id)
            ->orderBy('nome')
            ->get();
    }

    private function authorizeAtividade(Request $request, Atividade $atividade): void
    {
        abort_unless($atividade->disciplina()->where('id_usuario', $request->user()->id)->exists(), 404);
    }

    private function previousUrlWithoutModal(): string
    {
        $previous = url()->previous();
        $parts = parse_url($previous);

        if (! isset($parts['query'])) {
            return $previous;
        }

        parse_str($parts['query'], $query);
        unset($query['modal']);

        $url = ($parts['scheme'] ?? request()->getScheme()).'://'.($parts['host'] ?? request()->getHost());

        if (isset($parts['port'])) {
            $url .= ':'.$parts['port'];
        }

        $url .= $parts['path'] ?? '/';

        if ($query !== []) {
            $url .= '?'.http_build_query($query);
        }

        return $url;
    }

}
