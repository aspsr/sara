<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RuoliMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
         if (!Auth::check()) {
            Log::info('Utente non autenticato');
            abort(403, 'Unauthorized');
        }

        $user = Auth::user();
        //dd($user->ruolo()->first()->nome);
        if ($user->ruolo()->first()->nome !== $role || $user->stato == 0) {
            abort(403, 'Unauthorized');
        }
        return $next($request);    
    }
}
