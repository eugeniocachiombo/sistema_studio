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
            session()->put("estado", "O sistema está em modo online");

            if ($data && isset($data->datetime)) {
                $dataAtual = new \DateTime($data->datetime);
                $ano = $dataAtual->format('Y');
                $mes = $dataAtual->format('m');

                
                if (date("Y") < $ano) {
                    dd(
                        "Impossível aceder o sistema, verifique a data.",
                        "O Sistena só pode ser acessado em Angola"
                    );
                }

                if (date("m") < $mes) {
                    dd(
                        "Impossível aceder o sistema, verifique a data.",
                        "O Sistena só pode ser acessado em Angola"
                    );
                }
            } else {
                dd(
                    "Impossível aceder o sistema, verifique a data.",
                    "O Sistena só pode ser acessado em Angola"
                );
                //return redirect("/erro_data");
            }
        } catch (Exception $e) {
            session()->put("estado", "O sistema está em modo Offiline");
            //return redirect("/erro_data");
        }
    }
}
