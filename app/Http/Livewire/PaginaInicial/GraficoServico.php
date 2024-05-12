<?php

namespace App\Http\Livewire\PaginaInicial;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficoServico extends Component
{

    public function render()
    {
        return view('livewire.pagina-inicial.grafico-servico');
    }

    public function dadosJaneiro($mes)
    {
        $month = $mes;
        $year = Carbon::now()->year;
        $totais = array();

        $dados = DB::select("
            SELECT 'Gravacao' AS tipo, COUNT(*) as total FROM gravacaos
            WHERE YEAR(created_at) = ? AND MONTH(created_at) = ?
            UNION ALL
            SELECT 'Mixagem' AS tipo, COUNT(*) as total FROM mixagems
            WHERE YEAR(created_at) = ? AND MONTH(created_at) = ?
            UNION ALL
            SELECT 'Masterizacao' AS tipo, COUNT(*) as total FROM masterizacaos
            WHERE YEAR(created_at) = ? AND MONTH(created_at) = ?
        ", [$year, $month, $year, $month, $year, $month]);

        foreach ($dados as $item) {
            if ($item->tipo === 'Gravacao') {
                $totais["gravacao"] = $item->total;
            } elseif ($item->tipo === 'Mixagem') {
                $totais["mixagem"] = $item->total;
            } elseif ($item->tipo === 'Masterizacao') {
                $totais["masterizacao"] = $item->total;
            }
        }
        return $totais;
    }
}
