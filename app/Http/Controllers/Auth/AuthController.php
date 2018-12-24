<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login', 'register']]);
  }

  public function login (Request $request)
  {
    $credentials = $request->only(['email', 'password']);
    $token = auth()->attempt($credentials);

    if (!$token) {
        return response()->json([
          'message' => 'Register First!'
        ], 401);
    }

    return response()->json([
      'token' => $token,
      'type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60,
      'user' => auth()->user(),
    ]);
  }

  public function register (RegisterRequest $request) {
    $user = User::create([
      "name" => $request->name,
      "email" => $request->email,
      "password" => bcrypt($request->password)
    ]);
    return $user;
  }
}
