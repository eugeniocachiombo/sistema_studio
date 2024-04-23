<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\User;
use App\Models\Utilizador\RegistroActividade;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public $pagina_atual,$itens_por_pagina,$offset,$total_itens,$total_paginas;

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
        $this->pagina_atual = 0;
        $this->itens_por_pagina = 5;
        if (isset($_GET['pagina'])) {
            $this->pagina_atual = $_GET['pagina'];
        } else {
            $this->pagina_atual = 1;
        }
        $this->offset = ($this->pagina_atual - 1) * $this->itens_por_pagina;
        $this->total_itens = 100;

        $normal = DB::select('select * from registro_actividades ' .
        ' where user_id = ' . $this->utilizador_id . 
        ' and tipo_msg = ' . "'normal'");
        $alerta = DB::select('select * from registro_actividades ' .
        ' where user_id = ' . $this->utilizador_id . 
        ' and tipo_msg = ' . "'alerta'" .
        ' order by id desc limit ' . $this->itens_por_pagina . ' offset ' . $this->offset);
        $hoje = RegistroActividade::where("user_id", $this->utilizador_id)
                    ->whereDate("created_at", date("Y-m-d"))
                    ->orderby("id", "desc")
                    ->get();

        if($this->actividadesRecentes != ""){
            session()->put("paginaActividades", $this->actividadesRecentes);
        }
        
        switch (session("paginaActividades")) {
            case 'Normal':
                $this->total_paginas = ceil(count($normal) / 5);
                return DB::select('select * from registro_actividades ' .
            ' where user_id = ' . $this->utilizador_id . 
            ' and tipo_msg = ' . "'normal'" .
            ' order by id desc limit ' . $this->itens_por_pagina . ' offset ' . $this->offset);
                break;

            case 'Alerta':
                $this->total_paginas = ceil(count($alerta) / 5);
                return DB::select('select * from registro_actividades ' .
            ' where user_id = ' . $this->utilizador_id . 
            ' and tipo_msg = ' . "'alerta'" .
            ' order by id desc limit ' . $this->itens_por_pagina . ' offset ' . $this->offset);
                break;

            case 'Hoje':
                $this->total_paginas = ceil(count($hoje) / 5);
                return RegistroActividade::where("user_id", $this->utilizador_id)
                    ->whereDate("created_at", date("Y-m-d"))
                    ->orderby("id", "desc")
                    ->get();
                break;

            default:
            $this->total_paginas = ceil(count(RegistroActividade::all()) / 5);
             return DB::select('select * from registro_actividades ' .
            ' where user_id = ' . $this->utilizador_id . 
            ' order by id desc limit ' . $this->itens_por_pagina . ' offset ' . $this->offset);
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
