<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\Gravacao\Gravacao;
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
        $this->utilizadorLogado = $this->buscarDadosUtilizador($this->utilizador_id);
        return view('livewire.pagina-inicial.card-registros');
    }

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }

    public function buscarTotalGravacao(){
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
}
