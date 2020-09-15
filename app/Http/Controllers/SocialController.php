<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider, Request $request)
    {
        try {
            $userSocial = Socialite::driver('google')->stateless()->user();
            $user = User::where(['email' => $userSocial->getEmail()])->first();
            if($user) {
                $token = $user->createToken($request->state)->plainTextToken;
                return view('home', compact('token'));
            } else {
                $user = User::create([
                    'name' => $userSocial->getName(),
                    'email' => $userSocial->getEmail(),
                ]);
                $token = $user->createToken($request->state)->plainTextToken;
                return view('home', compact('token'));
            }
        } catch (\Exception $e) {
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return redirect('/');
    }

    public function current()
    {
        return response()->json(auth()->user(), 200);
    }

    public function users()
    {
        return response()->json(User::all()->except(Auth::id()), 200);
    }
}
