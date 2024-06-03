<?php

namespace App\Http\Controllers\panel;

use Illuminate\Support\Facades\Auth;

class PanelAuthController
{
    public function login()
    {
        return view('panel.login');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('panel.login');
    }

    public function auth()
    {
        request()->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        $auth = Auth::guard('web')->attempt(request()->only(['email', 'password']), true);
        if ($auth) {
            request()->session()->regenerate();
            return redirect()->route('panel.index');
        }
        
        return back()->withErrors([
            'error' => 'Логин или пароль введены неверно',
        ]);
    }
}
