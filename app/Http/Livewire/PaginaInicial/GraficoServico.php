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
            WHERE YEAR(updated_at) = ? AND MONTH(updated_at) = ? AND estado_gravacao = 'gravado'
            UNION ALL
            SELECT 'Mixagem' AS tipo, COUNT(*) as total FROM mixagems
            WHERE YEAR(updated_at) = ? AND MONTH(updated_at) = ? AND estado_mixagem = 'mixado'
            UNION ALL
            SELECT 'Masterizacao' AS tipo, COUNT(*) as total FROM masterizacaos
            WHERE YEAR(updated_at) = ? AND MONTH(updated_at) = ? AND estado_master = 'masterizado'
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
