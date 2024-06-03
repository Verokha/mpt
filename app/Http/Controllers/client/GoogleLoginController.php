<?php

namespace App\Http\Controllers\client;

use App\Http\Services\client\AuthService;
use App\Models\Student;
use Error;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(AuthService $authService)
    {
        try {
            $student = $authService->login();
            Auth::guard('student')->login($student, true);
        } catch (Error | Exception $e) {
            report($e);
        }
        
        return redirect()->route('page.home');
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        
        return redirect()->route('page.home');
    }
}
