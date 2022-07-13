<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\SignUpRequest;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Database\Eloquent\Factories\Factory;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    protected $jwt;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','signup']]);
       // $this->jwt = $jwt;
    }   

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
       //dd(Auth('api')->attempt($credentials));
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Email or password does not exists'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function signup(SignUpRequest $request)
    {
        $user = User::create($request->all());
        return $this->login($request);
    }

    

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3600,
            'user' => auth()->user()->name
        ]);
    }
}