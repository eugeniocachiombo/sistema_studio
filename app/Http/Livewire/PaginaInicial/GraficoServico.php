<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GraficoServico extends Component
{
    public $utilizador_id, $utilizadorLogado;

    public function mount()
    {
        $this->utilizador_id = Auth::user()->id;
        $this->utilizadorLogado = $this->buscarDadosUtilizador($this->utilizador_id);
    }

    public function render()
    {
        return view('livewire.pagina-inicial.grafico-servico');
    }

    public function dadosJaneiro($mes)
    {
        $month = $mes;
        $year = Carbon::now()->year;
        $totais = array();
        $dados = array();

        if ($this->utilizadorLogado->tipo_acesso == 3) {
            $cliente_id = 3;

            $dados = DB::select("
    SELECT 'Gravacao' AS tipo, COUNT(*) as total
    FROM gravacaos
    WHERE YEAR(gravacaos.updated_at) = ?
        AND MONTH(gravacaos.updated_at) = ?
        AND gravacaos.estado_gravacao = 'gravado'
        AND gravacaos.cliente_id = ?
    UNION ALL
    SELECT 'Mixagem' AS tipo, COUNT(*) as total
    FROM mixagems
    INNER JOIN gravacaos ON mixagems.gravacao_id = gravacaos.id
    WHERE YEAR(mixagems.updated_at) = ?
        AND MONTH(mixagems.updated_at) = ?
        AND mixagems.estado_mixagem = 'mixado'
        AND gravacaos.cliente_id = ?
    UNION ALL
    SELECT 'Masterizacao' AS tipo, COUNT(*) as total
    FROM masterizacaos
    INNER JOIN mixagems ON masterizacaos.mixagem_id = mixagems.id
    INNER JOIN gravacaos ON mixagems.gravacao_id = gravacaos.id
    WHERE YEAR(masterizacaos.updated_at) = ?
        AND MONTH(masterizacaos.updated_at) = ?
        AND masterizacaos.estado_master = 'masterizado'
        AND gravacaos.cliente_id = ?
", [$year, $month, $cliente_id, $year, $month, $cliente_id, $year, $month, $cliente_id]);

        } else {
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
        }

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

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }

}
