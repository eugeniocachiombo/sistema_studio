<?php

namespace App\Http\Livewire\Utilizador;

use App\Models\User;
use App\Models\Utilizador\FotoPerfil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class Perfil extends Component
{
    use WithFileUploads;

    public $utilizador_id;
    public $arquivo = null;
    public $nomeArquivo, $extensaoArquivo, $tamanhoArquivo;
    public $extensoesAceites = [
        "img" => ["jpg", "jpeg", "png"],
    ];
    public $caminhoArquivo = null, $tipoArquivo = null, $nomeOriginalArquivo = null, $extensaoOriginalArquivo = null;
    public $passeActual, $passeNova, $passeConfirmacao;
    public $alertaPasse = array();

    public function mount($alertaPasse)
    {
        $this->alertaPasse =  $alertaPasse;
        $this->utilizador_id = Auth::user()->id;
    }

    public function index()
    {
        return view('index.utilizador.perfil', ["alertaPasse" => $this->alertaPasse]);
    }

    public function render()
    {
        $this->setarDadosArquivo();
        return view('livewire.utilizador.perfil', ["alertaPasse" => $this->alertaPasse]);
    }

    public function buscarDadosUtilizador($id)
    {
        return User::find($id);
    }

    public function setarDadosArquivo()
    {
        if ($this->arquivo) {
            $this->nomeArquivo = $this->arquivo->getClientOriginalName();
            $this->extensaoArquivo = $this->arquivo->getClientOriginalExtension();
            $this->tamanhoArquivo = round($this->arquivo->getSize() / (1024 * 1024), 2) . " MB";
            $this->vereificarArquivoExiste();
        }
    }

    public function vereificarArquivoExiste()
    {
        if ($this->arquivo) {
            $this->caminhoArquivo = $this->verificarExtensaoArquivo($this->extensaoArquivo);
            if ($this->caminhoArquivo) {
                $this->tipoArquivo = $this->buscarTipoArquivo($this->extensaoArquivo);
                $this->extensaoOriginalArquivo = $this->extensaoArquivo;
                $this->nomeOriginalArquivo = $this->arquivo->getClientOriginalName();
                $this->cadastrarFotoPerfil();
            } else {
                $this->emit('alerta', ['mensagem' => 'Arquivo inválido', 'icon' => 'warning']);
                $this->limparCampos();
            }
        }
    }

    public function verificarExtensaoArquivo($extensaoArquivo)
    {
        $caminhoArquivo = "";
        foreach ($this->extensoesAceites as $chave => $extensao) {
            for ($i = 0; $i < count($extensao); $i++) {
                if ($extensao[$i] == $extensaoArquivo) {
                    $caminhoArquivo = $this->arquivo->store("uploads/" . $chave);
                    break;
                }
            }
        }
        return $caminhoArquivo;
    }

    public function buscarTipoArquivo($extensaoArquivo)
    {
        $tipo = "";
        foreach ($this->extensoesAceites as $chave => $extensao) {
            for ($i = 0; $i < count($extensao); $i++) {
                if ($extensao[$i] == $extensaoArquivo) {
                    $tipo = $chave;
                    break;
                }
            }
        }
        return $tipo;
    }

    public function cadastrarFotoPerfil()
    {
        $dados = [
            "caminho_arquivo" => $this->caminhoArquivo ? $this->caminhoArquivo : "",
            "tipo_arquivo" => $this->tipoArquivo ? $this->tipoArquivo : "",
            "nome_arquivo" => $this->nomeOriginalArquivo ? $this->nomeOriginalArquivo : "",
            "extensao_arquivo" => $this->extensaoOriginalArquivo ? $this->extensaoOriginalArquivo : "",
            "user_id" => $this->utilizador_id,
            "deleted_at" => null,
        ];
        $foto = FotoPerfil::where("user_id", $this->utilizador_id)->first();
        $this->inserirFoto($foto, $dados);
        $this->limparCampos();
    }

    public function inserirFoto($foto, $dados){
        if ($foto) {
            FotoPerfil::where("id", $foto->id)->update($dados);
            $this->emit('alerta', ['mensagem' => 'Foto actualizada com sucesso', 'icon' => 'success']);
        } else {
            FotoPerfil::create($dados);
            $this->emit('alerta', ['mensagem' => 'Foto inserida com sucesso', 'icon' => 'success']);
        }
    }

    public function limparCampos()
    {
        $this->tipoArquivo = null;
        $this->nomeArquivo = null;
        $this->extensaoOriginalArquivo = null;
        $this->nomeOriginalArquivo = null;
        $this->arquivo = null;
        $this->caminhoArquivo = null;
        $this->tipoArquivo = null;
        $this->nomeOriginalArquivo = null;
        $this->extensaoOriginalArquivo = null;
    }

    public function buscarFotoPerfil($idUtilizador){
         $foto = FotoPerfil::where("user_id", $idUtilizador)->orderby("id", "desc")->first();
         if ($foto) {
            $caminho = '../storage/app/public/' . $foto->caminho_arquivo;
            if (file_exists($caminho)) {
                return $foto;
            } else {
                return null;
            }
         }else{
            return null;
         }
    }

    public function clickBtnEliminarFoto($idUtilizador){
         $foto = FotoPerfil::where("user_id", $idUtilizador)->orderby("id", "desc")->first();
         if ($foto) {
            $caminho = '../storage/app/public/' . $foto->caminho_arquivo;
            if (file_exists($caminho)) {
                $this->eliminarFotoPerfil();
            } else {
                $this->emit('alerta', ['mensagem' => 'Requer uma foto no perfil', 'icon' => 'error']);
            }
         }else{
            $this->emit('alerta', ['mensagem' => 'Requer uma foto no perfil', 'icon' => 'error']);
         }
    }

    public function eliminarFotoPerfil(){
        FotoPerfil::where("user_id", $this->utilizador_id)->delete();
        $this->emit('alerta', ['mensagem' => 'Foto eliminada com sucesso', 'icon' => 'success']);
    }

    public function alterarPalavraPasse(Request $request){
        $utilizador = Auth::user();
        $this->passeActual = $request->input('passeActual');
        $this->passeNova = $request->input('passeNova');
        $this->passeConfirmacao = $request->input('passeConfirmacao');
        session()->put("alterarPasse", true);
        $alertaPasse = $this->actualizarPasse($utilizador, $this->passeActual, $this->passeNova, $this->passeConfirmacao);
        return view('index.utilizador.perfil', ["alertaPasse" => $alertaPasse]);
    }

    public function actualizarPasse($utilizador, $passeActual, $passeNova, $passeConfirmacao){        
        if (Hash::check($passeActual, $utilizador->password)) {
            if($passeNova == $passeActual){
                return ['mensagem' => 'Palavra-passe Nova deve ser diferente da Antiga', 'icon' => 'error'];
            }else if($passeNova == $passeConfirmacao){
                User::where('id', $utilizador->id)->update(['password' => Hash::make($passeNova)]);
                return ['mensagem' => 'Palavra-passe alterada com sucesso', 'icon' => 'success'];
            } else{
                return ['mensagem' => 'Palavra-passe Nova e a de Confirmação devem ser as mesmas', 'icon' => 'warning', 'tempo' => 5000];
            }
        }else{
            return ['mensagem' => 'Palavra-passe antiga está errada', 'icon' => 'error'];
        }
    }
}
