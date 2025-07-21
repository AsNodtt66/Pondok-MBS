<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::guard('Pengguna')->check()) {
            return redirect()->route('login');
        }

        $user = Auth::guard('Pengguna')->user();
        
        if (!$user->role) {
            Auth::guard('Pengguna')->logout();
            return redirect()->route('login')->with('error', 'Akun tidak memiliki peran yang valid.');
        }

        if (strtolower($user->role->Jenis_role) !== strtolower($role)) {
            return redirect()->route('dashboard.' . strtolower($user->role->Jenis_role))
                ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
    
}