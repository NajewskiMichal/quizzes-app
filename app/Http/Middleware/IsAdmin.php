<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Sprawdza czy zalogowany? ORAZ Czy ma flagę admina?
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }
        // Jeśli nie, wyrzuć na stronę główną z błędem
        return redirect('/')->with('error', 'Brak uprawnień administratora.');
    }
}