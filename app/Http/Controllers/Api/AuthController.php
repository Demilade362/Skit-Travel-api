<?php

namespace App\Http\Controllers\Api;

use App\Events\UserRegistration;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        $request->validated();

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        Auth::login($user);
        event(new UserRegistration($user->email));

        return response(
            [
                'user' => $user,
                'token' => $user->createToken($user->name)->plainTextToken
            ],
        );
    }

    public function login(AuthLoginRequest $request)
    {
        $request->validated();

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            abort(403, [
                'message' => "Credientials Not Match Our Records"
            ]);
        }

        Auth::login($user);

        return response([
            'user' => $user,
            'token' => $user->createToken($user->name)->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => "You Have Successfully Logout",
        ]);
    }
}
