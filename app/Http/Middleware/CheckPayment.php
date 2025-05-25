<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPayment
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
        // Vérifie si l'utilisateur est connecté
        if (Auth::check()) {
            // Si l'utilisateur n'a pas payé, redirige vers la page de paiement
            if (!Auth::user()->is_paid) {
                return redirect()->route('payment.form')
                    ->with('error', 'Veuillez finaliser votre paiement pour continuer.');
            }
        }

        return $next($request);
    }
}
