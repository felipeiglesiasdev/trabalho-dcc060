<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // VERIFICA SE O USUÁRIO ESTÁ LOGADO E SE O TIPO DELE É 'ADMIN'.
        if (auth()->check() && auth()->user()->tipo === 'admin') {
            // SE FOR ADMIN, DEIXA A REQUISIÇÃO PASSAR.
            return $next($request);
        }

        // SE NÃO FOR ADMIN, INTERROMPE E MOSTRA A PÁGINA DE ERRO 403.
        abort(403, 'Acesso não autorizado.');
    }
}
