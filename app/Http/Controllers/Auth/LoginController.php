<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth:Pengguna')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectPath());
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        return redirect()->intended($this->redirectPath());
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $sessionData = [
                'Timestamp' => now()->format('Y-m-d H:i:s'),
                'CSRF Token' => csrf_token(),
                'Session Token' => $request->session()->token(),
                'Session ID' => $request->session()->getId(),
                'User Data' => $user->toArray(),
                'Role Data' => $user->role ? $user->role->toArray() : 'Role not loaded'
            ];
            
            $request->session()->regenerate();
            return $this->sendLoginResponse($request);
        }

        
        return $this->sendFailedLoginResponse($request);
    }

    protected function redirectTo()
    {
        $user = Auth::guard('Pengguna')->user()->load('role');

        // Pastikan peran pengguna valid. Jika tidak, logout dan arahkan ke halaman login.
        if (!$user->role || !in_array($user->role_id, [Role::ADMIN, Role::PENGURUS, Role::SANTRI, Role::WALI])) {
            Auth::guard('Pengguna')->logout();
            return '/login?error=invalid_role';
        }

        $redirect = match($user->role_id) {
            Role::ADMIN => route('dashboard.admin.dashboard'),
            Role::PENGURUS => route('dashboard.pengurus'),
            Role::SANTRI => route('dashboard.santri'),
            Role::WALI => route('dashboard.wali'),
            default => '/login?error=invalid_role'
        };

        return $redirect;
    }
    public function logout(Request $request)
    {
        Auth::guard('Pengguna')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}