<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function googleCallback()
    {
        $googleUser =  Socialite::driver('google')->stateless()->user();
        $user = User::updateorCreate(
            [
                'email' => $googleUser->email
            ],
            [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
            ]
        );

        $token =  $user->createToken(env('APP_NAME'))->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
            'success' => true,
        ]);
    }
}
