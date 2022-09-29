<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Requests\{LoginRequest, VerifyAccount, 
    ResetPassword, CreateUser, PasswordReset as PassReset};

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(CreateUser $request)
    {
        return $this->authService->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request);
    }

    public function logout()
    {
        return $this->authService->logout();
    }

    public function refresh()
    {
        return $this->authService->refresh();
    }

    public function verifyEmail(VerifyAccount $request)
    {
        return $this->authService->verifyEmail($request);
    }

    public function resetPassword(ResetPassword $request)
    {
        return $this->authService->resetPassword($request);
    }

    public function verifyResetToken(Request $request)
    {
        return $this->authService->verifyResetToken($request);
    }

    public function passwordReset(PassReset $request)
    {
        return $this->authService->passwordReset($request);
    }

}
