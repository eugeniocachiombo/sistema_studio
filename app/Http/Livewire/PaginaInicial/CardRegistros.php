<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\Gravacao\Gravacao;
use App\Models\Masterizacao\Masterizacao;
use App\Models\Mixagem\Mixagem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CardRegistros extends Component
{
    public $gravacao, $mixagem, $masterizacao;
    public $totalGravacao, $totalMixagem, $totalMasterizacao;
    public $utilizador_id, $utilizadorLogado;

    public function mount()
    {
        $this->utilizador_id = Auth::user()->id;
        $this->utilizadorLogado = $this->buscarDadosUtilizador($this->utilizador_id);
    }

    public function render()
    {
        $this->verificarSeClienteOuFunc();
        return view('livewire.pagina-inicial.card-registros');
    }

    public function verificarSeClienteOuFunc()
    {
        if ($this->utilizadorLogado->tipo_acesso == 3) {
            $this->buscarTotalGravacaoCliente();
            $this->buscarTotalMixagemCliente();
            $this->buscarTotalMasterizacaoCliente();
        } else {
            $this->buscarTotalGravacao();
            $this->buscarTotalMixagem();
            $this->buscarTotalMasterizacao();
        }
    }

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }

    public function buscarTotalGravacao()
    {
        switch ($this->gravacao) {
            case 'Hoje':
                $this->totalGravacao = Gravacao::whereDate("data_gravacao", Carbon::today())->get();
                break;
            case 'Pendentes':
                $this->totalGravacao = Gravacao::where("estado_gravacao", "pendente")->get();
                break;
            case 'Concluidas':
                $this->totalGravacao = Gravacao::where("estado_gravacao", "gravado")->get();
                break;
            default:
                $this->totalGravacao = Gravacao::all();
                break;
        }
    }

    public function buscarTotalMixagem()
    {
        switch ($this->mixagem) {
            case 'Hoje':
                $this->totalMixagem = Mixagem::whereDate("data_mixagem", Carbon::today())->get();
                break;
            case 'Pendentes':
                $this->totalMixagem = Mixagem::where("estado_mixagem", "pendente")->get();
                break;
            case 'Concluidas':
                $this->totalMixagem = Mixagem::where("estado_mixagem", "mixado")->get();
                break;
            default:
                $this->totalMixagem = Mixagem::all();
                break;
        }
    }

    public function buscarTotalMasterizacao()
    {
        switch ($this->masterizacao) {
            case 'Hoje':
                $this->totalMasterizacao = Masterizacao::whereDate("data_master", Carbon::today())->get();
                break;
            case 'Pendentes':
                $this->totalMasterizacao = Masterizacao::where("estado_master", "pendente")->get();
                break;
            case 'Concluidas':
                $this->totalMasterizacao = Masterizacao::where("estado_master", "masterizado")->get();
                break;
            default:
                $this->totalMasterizacao = Masterizacao::all();
                break;
        }
    }

    public function buscarPercentagem($valor, $estado)
    {
        $gravacao = null;
        $mixagem = null;
        $masterizacao = null;
        switch ($estado) {
            case 'Hoje':
                $gravacao = Gravacao::whereDate("data_gravacao", Carbon::today())->count();
                $mixagem = Mixagem::whereDate("data_mixagem", Carbon::today())->count();
                $masterizacao = Masterizacao::whereDate("data_master", Carbon::today())->count();
                break;
            case 'Pendentes':
                $gravacao = Gravacao::where("estado_gravacao", "pendente")->get()->count();
                $mixagem = Mixagem::where("estado_mixagem", "pendente")->get()->count();
                $masterizacao = Masterizacao::where("estado_master", "pendente")->get()->count();
                break;
            case 'Concluidas':
                $gravacao = Gravacao::where("estado_gravacao", "gravado")->get()->count();
                $mixagem = Mixagem::where("estado_mixagem", "mixado")->get()->count();
                $masterizacao = Masterizacao::where("estado_master", "masterizado")->get()->count();
                break;
            default:
                $gravacao = Gravacao::all()->count();
                $mixagem = Mixagem::all()->count();
                $masterizacao = Masterizacao::all()->count();
                break;
        }
        $somatorio = $gravacao + $mixagem + $masterizacao;
        return $somatorio > 0 ? ($valor * 100) / $somatorio : 0;
    }

    public function buscarTotalGravacaoCliente()
    {
        switch ($this->gravacao) {
            case 'Hoje':
                $this->totalGravacao = Gravacao::whereDate("data_gravacao", Carbon::today())
                    ->where("cliente_id", $this->utilizadorLogado->id)
                    ->get();
                break;
            case 'Pendentes':
                $this->totalGravacao = Gravacao::where("estado_gravacao", "pendente")
                    ->where("cliente_id", $this->utilizadorLogado->id)
                    ->get();
                break;
            case 'Concluidas':
                $this->totalGravacao = Gravacao::where("estado_gravacao", "gravado")->where("cliente_id", $this->utilizadorLogado->id)->get();
                break;
            default:
                $this->totalGravacao = Gravacao::where("cliente_id", $this->utilizadorLogado->id)->get();
                break;
        }
    }

    public function buscarTotalMixagemCliente()
    {
        switch ($this->mixagem) {
            case 'Hoje':
                $this->totalMixagem = Mixagem::join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->whereDate('mixagems.data_mixagem', Carbon::today())
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get();
                break;
            case 'Pendentes':
                $this->totalMixagem = Mixagem::join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where("mixagems.estado_mixagem", "pendente")
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get();
                break;
            case 'Concluidas':
                $this->totalMixagem = Mixagem::join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where("mixagems.estado_mixagem", "mixado")
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get();
                break;
            default:
                $this->totalMixagem = Mixagem::join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get();
                break;
        }
    }

    public function buscarTotalMasterizacaoCliente()
    {
        switch ($this->masterizacao) {
            case 'Hoje':
                $this->totalMasterizacao = Masterizacao::join('mixagems', 'masterizacaos.mixagem_id', '=', 'mixagems.id')
                    ->join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->whereDate('masterizacaos.data_master', Carbon::today())
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get();
                break;
            case 'Pendentes':
                $this->totalMasterizacao = Masterizacao::join('mixagems', 'masterizacaos.mixagem_id', '=', 'mixagems.id')
                    ->join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where('masterizacaos.estado_master', "pendente")
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get();
                break;
            case 'Concluidas':
                $this->totalMasterizacao = Masterizacao::join('mixagems', 'masterizacaos.mixagem_id', '=', 'mixagems.id')
                    ->join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where('masterizacaos.estado_master', "masterizado")
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get();
                break;
            default:
                $this->totalMasterizacao = Masterizacao::join('mixagems', 'masterizacaos.mixagem_id', '=', 'mixagems.id')
                    ->join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get();
                break;
        }
    }

    public function buscarPercentagemCliente($valor, $estado)
    {
        $gravacao = null;
        $mixagem = null;
        $masterizacao = null;
        switch ($estado) {
            case 'Hoje':
                $gravacao = Gravacao::whereDate("data_gravacao", Carbon::today())
                    ->where("cliente_id", $this->utilizadorLogado->id)->get()->count();
                $mixagem = Mixagem::join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->whereDate('mixagems.data_mixagem', Carbon::today())
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)->get()->count();
                $masterizacao = Masterizacao::join('mixagems', 'masterizacaos.mixagem_id', '=', 'mixagems.id')
                    ->join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->whereDate('masterizacaos.data_master', Carbon::today())
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)->get()->count();
                break;
            case 'Pendentes':
                $gravacao = Gravacao::where("estado_gravacao", "pendente")
                    ->where("cliente_id", $this->utilizadorLogado->id)
                    ->get()->count();
                $mixagem = Mixagem::join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where("mixagems.estado_mixagem", "pendente")
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get()->count();
                $masterizacao = Masterizacao::join('mixagems', 'masterizacaos.mixagem_id', '=', 'mixagems.id')
                    ->join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where('masterizacaos.estado_master', "pendente")
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get()->count();
                break;
            case 'Concluidas':
                $gravacao = Gravacao::where("estado_gravacao", "gravado")->where("cliente_id", $this->utilizadorLogado)->get()->count();
                $mixagem = Mixagem::join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where("mixagems.estado_mixagem", "mixado")
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get()->count();
                $masterizacao = Masterizacao::join('mixagems', 'masterizacaos.mixagem_id', '=', 'mixagems.id')
                    ->join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where('masterizacaos.estado_master', "masterizado")
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get()->count();
                break;
            default:
                $gravacao = Gravacao::where("cliente_id", $this->utilizadorLogado->id)->get()->count();
                $mixagem = Mixagem::join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get()->count();
                $masterizacao = Masterizacao::join('mixagems', 'masterizacaos.mixagem_id', '=', 'mixagems.id')
                    ->join('gravacaos', 'mixagems.gravacao_id', '=', 'gravacaos.id')
                    ->where('gravacaos.cliente_id', $this->utilizadorLogado->id)
                    ->get()->count();
                break;
        }
        $somatorio = $gravacao + $mixagem + $masterizacao;
        return $somatorio > 0 ? ($valor * 100) / $somatorio : 0;
    }

}
