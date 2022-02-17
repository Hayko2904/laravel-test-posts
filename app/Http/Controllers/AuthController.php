<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $user = $this->authService->getUser($request->toArray());

        if ($user) {
            $this->authService->login($request->only('email', 'password'));
            return redirect()->route('home');
        }

        return redirect()->route('login');
    }

    public function registration(RegistrationRequest $request)
    {
        $user = $this->authService->registration($request->toArray());
        if ($user) {
            $this->authService->login($request->only('email', 'phone', 'password'));
        }
        if (auth()->user()) {
            return redirect()->route('home');
        }

        return redirect()->route('login');
    }

    public function logout()
    {
        $this->authService->logout();

        return redirect()->route('login');
    }
}
