<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        
        // Cek apakah user ada DAN perannya adalah 'admin'
        if ($request->user() && $request->user()->peran === 'admin') {
            return $next($request);
        }

        // Jika user belum login atau perannya bukan admin, tolak
        return redirect('/')->with('error', 'Anda tidak memiliki akses!');
    }
}
