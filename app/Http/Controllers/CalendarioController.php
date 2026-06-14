<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\Disciplina;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalendarioController extends Controller
{
    public function index(Request $request): View
    {
        $timezone = 'America/Sao_Paulo';
        $mode = $request->query('modo') === 'mensal' ? 'mensal' : 'semanal';
        $currentDate = Carbon::parse($request->query('data', now($timezone)->toDateString()), $timezone);

        $periodStart = $mode === 'mensal'
            ? $currentDate->copy()->startOfMonth()
            : $currentDate->copy()->startOfWeek(CarbonInterface::SUNDAY);

        $periodEnd = $mode === 'mensal'
            ? $currentDate->copy()->endOfMonth()
            : $periodStart->copy()->addDays(6)->endOfDay();

        $disciplinas = Disciplina::query()
            ->where('id_usuario', $request->user()->id)
            ->orderBy('nome')
            ->get();

        $atividades = Atividade::query()
            ->with('disciplina')
            ->whereIn('id_disciplina', $disciplinas->pluck('id'))
            ->whereBetween('prazo', [$periodStart, $periodEnd])
            ->orderBy('prazo')
            ->get();

        return view('calendario.index', [
            'atividades' => $atividades,
            'currentDate' => $currentDate,
            'disciplinas' => $disciplinas,
            'mode' => $mode,
            'periodEnd' => $periodEnd,
            'periodStart' => $periodStart,
            'timezone' => $timezone,
        ]);
    }
}
