<?php

namespace App\Http\Livewire\PaginaInicial;

use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PaginaInicial extends Component
{
    public $gravacao, $mixagem, $masterizacao;
    public $utilizador_id, $utilizadorLogado;
    public $actividadesRecentes;
    public $listaClientes = array();
    public $pagina_atual, $itens_por_pagina, $offset, $total_itens, $total_paginas;
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
        $this->pagina_atual = 0;
        $this->itens_por_pagina = 4;
        isset($_GET['pagina']) ? $this->pagina_atual = $_GET['pagina'] : $this->pagina_atual = 1;
        $this->offset = ($this->pagina_atual - 1) * $this->itens_por_pagina;
        $this->total_itens = 100;
        $this->setSessaoPaginaActividades();

        switch (session("paginaActividades")) {
            case 'Normal':
                return $this->buscarActividadesTipoNormal();
                break;

            case 'Alerta':
                return $this->buscarActividadesTipoAlerta();
                break;

            case 'Hoje':
                return $this->buscarActividadesRecentesHoje();
                break;

            default:
                return $this->buscarTodasActividadesRecentes();
                break;
        }

    }

    public function setSessaoPaginaActividades()
    {
        if ($this->actividadesRecentes != "") {
            session()->put("paginaActividades", $this->actividadesRecentes);
        }
    }

    public function buscarActividadesTipoNormal()
    {
        $normal = DB::select('select * from registro_actividades ' .
            ' where user_id = ' . $this->utilizador_id .
            ' and tipo_msg = ' . "'normal'");
        $this->total_paginas = ceil(count($normal) / 4);
        return DB::select('select * from registro_actividades ' .
            ' where user_id = ' . $this->utilizador_id .
            ' and tipo_msg = ' . "'normal'" .
            ' order by id desc limit ' . $this->itens_por_pagina . ' offset ' . $this->offset);
    }

    public function buscarActividadesTipoAlerta()
    {
        $alerta = DB::select('select * from registro_actividades ' .
            ' where user_id = ' . $this->utilizador_id .
            ' and tipo_msg = ' . "'alerta'");
        $this->total_paginas = ceil(count($alerta) / 5);
        return DB::select('select * from registro_actividades ' .
            ' where user_id = ' . $this->utilizador_id .
            ' and tipo_msg = ' . "'alerta'" .
            ' order by id desc limit ' . $this->itens_por_pagina . ' offset ' . $this->offset);
    }

    public function buscarActividadesRecentesHoje()
    {
        $hoje = DB::select('select * from registro_actividades ' .
            ' where user_id = ' . $this->utilizador_id .
            ' and DATE(created_at) = curdate()');
        $this->total_paginas = ceil(count($hoje) / 5);
        return DB::select('select * from registro_actividades ' .
            ' where user_id = ' . $this->utilizador_id .
            ' and DATE(created_at) = curdate()' .
            ' order by id desc limit ' . $this->itens_por_pagina . ' offset ' . $this->offset);
    }

    public function buscarTodasActividadesRecentes()
    {
        $todas = DB::select('select * from registro_actividades ' .
            ' where user_id = ' . $this->utilizador_id);
        $this->total_paginas = ceil(count($todas) / 5);
        return DB::select('select * from registro_actividades ' .
            ' where user_id = ' . $this->utilizador_id .
            ' order by id desc limit ' . $this->itens_por_pagina . ' offset ' . $this->offset);
    }

    public function buscarNomeUsuario($id)
    {
        return User::find($id)->name;
    }

    public function formatarData($data)
    {
        $data_hora = new DateTime($data);
        $agora = new DateTime('now');
        $intervalo = $data_hora->diff($agora);

        if ($intervalo->days == 0) {
            if ($intervalo->h == 0) {
                $data_formatada = $intervalo->i . ' min';
            } else {
                $data_formatada = $intervalo->h . ' hr';
            }
        } elseif ($intervalo->days == 1) {
            $data_formatada = 'Ontem às ' . $data_hora->format('H:i');
        } elseif ($intervalo->days >= 2 && $intervalo->days <= 6) {
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
        } elseif ($intervalo->days >= 7) {
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
            $data_formatada = $data_hora->format('d \d\e F \d\e Y');
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
