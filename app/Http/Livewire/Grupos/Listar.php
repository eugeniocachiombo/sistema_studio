<?php

namespace App\Http\Livewire\Grupos;

use App\Models\Grupo\Grupo;
use App\Models\Grupo\GrupoCliente;
use App\Models\User;
use Livewire\Component;

class Listar extends Component
{
    public $listaGrupo = array();

    public function index()
    {
        return view('index.grupos.listar');
    }

    public function render()
    {
        $this->listaGrupo = Grupo::all();
        return view('livewire.grupos.listar');
    }

    public function buscarClientesGrupo($id)
    {
        return GrupoCliente::where("grupo_id", $id)->get();
    }

    public function cortarUltimavirgula($todosMembros)
    {
        $membrosEscolhidos = '';
        $count = count($todosMembros);
        foreach ($todosMembros as $index => $item) {
            $nomeMembro = $this->buscarNomeMembro($item->membro);

            if ($index === 0) {
                $membrosEscolhidos .= $nomeMembro;
            } elseif ($index === $count - 1) {
                $membrosEscolhidos .= " e $nomeMembro";
            } else {
                $membrosEscolhidos .= ", $nomeMembro";
            }
        }

        $membrosEscolhidos = str_replace(" (Grupo)", "", $membrosEscolhidos);
        $membrosEscolhidos = str_replace(" (Anônimo)", "", $membrosEscolhidos);
        return rtrim($membrosEscolhidos);
    }

    public function eliminarGrupo($id){
        Grupo::find($id)->delete();
        $this->emit('alerta', ['mensagem' => 'Grupo eliminado do sistema', 'icon' => 'success', 'tempo' => 5000]);
        $this->emit('atrazar_redirect', ['caminho' => '/grupo/listar', 'tempo' => 2500]);
    }

    public function buscarNomeMembro($id)
    {
        $dadosPartic = User::find($id);
        return $dadosPartic ? $dadosPartic->name : "";
    }
}
