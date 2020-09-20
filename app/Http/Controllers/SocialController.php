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
            echo $e;
        }
    }

    /**
     * @OA\Get(
     *      path="/logout",
     *      operationId="Logout",
     *      tags={"Users"},
     *      security={"Bearer"},
     *      summary="Logout",
     *      description="Logout",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     * )
     */
    public function logout()
    {
        Auth::user()->tokens()->delete();
        return redirect('/');
    }

    /**
     * @OA\Get(
     *      path="/current",
     *      operationId="getCurrentUser",
     *      tags={"Users"},
     *     security={"Bearer"},
     *      summary="Get current user information",
     *      description="Returns user data",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
     *       ),
     * )
     */
    public function current()
    {
        return response()->json(auth()->user(), 200);
    }
    /**
     * @OA\Get(
     *      path="/users",
     *      operationId="getAllUsersExceptMe",
     *      tags={"Users"},
     *      security={"Bearer"},
     *      summary="Get all users except me",
     *      description="Returns all users data",
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *        @OA\JsonContent(
     *             type="object",
     *                type="object",
     *                example={{
     *                  "id": 1,
     *                  "name": "Bob",
     *                  "email": "Fanger",
     *                  "created_at": "2020-09-16 18:47:59",
     *                  "updated_at": "2020-09-16 18:47:59",
     *                }, {
     *                  "id": "number",
     *                  "name": "",
     *                  "email": "",
     *                  "created_at": "",
     *                  "updated_at": "",
     *                }},
     *        ),
     *     ),
     * )
     */
    public function users()
    {
        return response()->json(User::all()->except(Auth::id()), 200);
    }
}
