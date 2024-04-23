<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\User;
use App\Models\Utilizador\RegistroActividade;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaginaInicial extends Component
{
    public $gravacao;
    public $mixagem;
    public $masterizacao;
    public $utilizador_id;
    public $utilizadorLogado;
    public $actividadesRecentes;
    public $listaClientes = array();
    protected $todasActividadesUtl;

    public function mount()
    {
        $this->listaClientes = User::where("tipo_acesso", 3)->get();
        $this->utilizador_id = Auth::user()->id;
    }

    public function index()
    {
        return view('index.pagina-inicial.pagina-inicial');
    }

    public function render()
    {
        $this->todasActividadesUtl = $this->buscarTodasActividadesUtl();
        $this->utilizadorLogado = $this->buscarDadosUtilizador($this->utilizador_id);
        return view('livewire.pagina-inicial.pagina-inicial', ["todasActividadesUtl" => $this->todasActividadesUtl]);
    }

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }

    public function buscarTodasActividadesUtl()
    {
        switch ($this->actividadesRecentes) {
            case 'Todas':
                return RegistroActividade::where("user_id", $this->utilizador_id)
                    ->orderby("id", "desc")
                    ->paginate(5);
                break;
            case 'Normal':
                return RegistroActividade::where("user_id", $this->utilizador_id)
                    ->where("tipo_msg", "normal")
                    ->orderby("id", "desc")
                    ->paginate(5);
                break;
            case 'Alerta':
                return RegistroActividade::where("user_id", $this->utilizador_id)
                    ->where("tipo_msg", "alerta")
                    ->orderby("id", "desc")
                    ->paginate(5);
                break;
            case 'Hoje':
                return RegistroActividade::where("user_id", $this->utilizador_id)
                    ->where("created_at", Carbon::today())
                    ->orderby("id", "desc")
                    ->paginate(5);
                break;

            default:
            return RegistroActividade::where("user_id", $this->utilizador_id)
            ->orderby("id", "desc")
            ->paginate(5);
                break;
        }

    }

    public function buscarNomeUsuario($id)
    {
        return User::find($id)->name;
    }

    public function formatarData($data)
    {
        $data_hora = new DateTime($data);
        $agora = new DateTime('now');
        $diferenca = $data_hora->diff($agora)->days;
        if ($diferenca == 0) {
            $data_formatada = 'Hoje às ' . $data_hora->format('H:i');
        } elseif ($diferenca == 1) {
            $data_formatada = 'Ontem às ' . $data_hora->format('H:i');
        } elseif ($diferenca >= 2 && $diferenca <= 6) {
            $dias_semana = array(
                'Sunday' => 'Domingo',
                'Monday' => 'Segunda-feira',
                'Tuesday' => 'Terça-feira',
                'Wednesday' => 'Quarta-feira',
                'Thursday' => 'Quinta-feira',
                'Friday' => 'Sexta-feira',
                'Saturday' => 'Sábado',
            );
            $data_formatada = $data_hora->format('l \à\s H:i');
            $data_formatada = strtr($data_formatada, $dias_semana);
        } elseif ($diferenca >= 7) {
            $meses = array(
                'January' => 'Janeiro',
                'February' => 'Fevereiro',
                'March' => 'Março',
                'April' => 'Abril',
                'May' => 'Maio',
                'June' => 'Junho',
                'July' => 'Julho',
                'August' => 'Agosto',
                'September' => 'Setembro',
                'October' => 'Outubro',
                'November' => 'Novembro',
                'December' => 'Dezembro',
            );
            $data_formatada = $data_hora->format('d \d\e F \d\e Y \à\s H:i');
            $data_formatada = strtr($data_formatada, $meses);
        }
        return $data_formatada;
    }

    public function corTexto($valor)
    {
        switch ($valor) {
            case "normal":
                return "text-success";
                break;
            case "alerta":
                return "text-warning";
                break;
            default:
                return "text-success";
                break;
        }
    }
}
