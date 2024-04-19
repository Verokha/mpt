<?php

namespace App\Http\Services\client;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthService
{
    public function login()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $student = Student::where('email', $googleUser->email)->first();
        if (!$student) {
            $student = Student::create([
                'email' => $googleUser->email,
                'first_name' => $googleUser->user['given_name'],
                'second_name' => $googleUser->user['family_name'],
            ]);
        }

        return $student;
    }
}
