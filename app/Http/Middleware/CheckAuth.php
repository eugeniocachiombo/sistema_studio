<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->verificarData();
        if (!Auth::check()) {
            return redirect()->route('utilizador.autenticacao');
        }
        return $next($request);
    }

    public function verificarData()
    {
        $url = 'http://worldtimeapi.org/api/timezone/Africa/Luanda';

        try {
            $response = file_get_contents($url);
            $data = json_decode($response);
            session()->put("estado", "Modo online");

            if ($data && isset($data->datetime)) {
                $dataInternet = new \DateTime($data->datetime);
                $dataComputador = new \DateTime(date("Y-m-dTH:i:s"));

                $dataComputador->setTime($dataComputador->format('H'), $dataComputador->format('i'), 0);
                $dataInternet->setTime($dataInternet->format('H'), $dataInternet->format('i'), 0);
                
                if ($dataComputador != $dataInternet) {
                    session()->put("mensagem", "O Sistema só pode ser acessado em Angola");
                    ?> <script> window.location = "/erro_data"; </script> <?php
                }
            } else {
                session()->put("mensagem", "Erro de conexao a internet, impossível buscar a localização");
                ?> <script> window.location = "/erro_data"; </script> <?php
            }
        } catch (Exception $e) {
            session()->put("estado", "Modo offline");
            session()->forget("mensagem");
        }
    }
}
?>

