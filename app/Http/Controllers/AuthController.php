<?php 
namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Services\RegisterUserService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    protected RegisterUserService $registerUserService;

    public function __construct(RegisterUserService $registerUserService)
    {
        $this->registerUserService = $registerUserService;
    }

    public function register(RegisterUserRequest $request)
    {
        $user = $this->registerUserService->register($request->validated());

        return response()->json(['message' => 'Utilisateur créé avec succès'], 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Identifiants invalides'], 401);
        }

        return response()->json(compact('token'));
    }
}
