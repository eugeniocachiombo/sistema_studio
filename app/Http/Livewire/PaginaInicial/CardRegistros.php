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
    }

    public function render()
    {
        $this->buscarTotalGravacao();
        $this->buscarTotalMixagem();
        $this->buscarTotalMasterizacao();
        $this->utilizadorLogado = $this->buscarDadosUtilizador($this->utilizador_id);
        return view('livewire.pagina-inicial.card-registros');
    }

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }

    public function buscarTotalGravacao()
    {
        switch ($this->gravacao) {
            case 'Hoje':
                $this->totalGravacao = Gravacao::where("created_at", Carbon::today())->get();
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
                $this->totalMixagem = Mixagem::where("created_at", Carbon::today())->get();
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
                $this->totalMasterizacao = Masterizacao::where("created_at", Carbon::today())->get();
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
                $gravacao = Gravacao::where("created_at", Carbon::today())->get()->count();
                $mixagem = Mixagem::where("created_at", Carbon::today())->get()->count();
                $masterizacao = Masterizacao::where("created_at", Carbon::today())->get()->count();
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
}
