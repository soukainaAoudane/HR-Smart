<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsManager
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }
        if (! Auth::user()->isManager()) {
            abort(403, 'Accès non autorisé - Vous devez être un manager pour accéder à cette page.');
        }
        return $next($request);
    }
}