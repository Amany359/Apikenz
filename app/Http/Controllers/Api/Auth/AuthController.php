<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserValidator;
use App\Http\Requests\Auth\LoginUserValidator;
use App\Http\Requests\Auth\VerifyAccount;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helpers;
use App\Services\AuthService; // ✅ استدعاء AuthService

class AuthController extends Controller
{
    protected $authService;

    // ✅ تمرير AuthService عبر الـ Constructor
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // تسجيل المستخدم
    public function register(RegisterUserValidator $request)
    {
        $user = $this->authService->registerUser($request->all());

        return Helpers::jsonResponse(true, ['verification_code' => $user->verification_code], 'تم التسجيل بنجاح. تحقق من هاتفك لتفعيل الحساب.', 201);
    }

    // توثيق الحساب عبر رمز التحقق
    public function verifyAccount(VerifyAccount $request)
    {
        $response = $this->authService->verifyAccount($request->all());

        return Helpers::jsonResponse($response['success'], null, $response['message'], $response['success'] ? 200 : 400);
    }

    // تسجيل الدخول
    public function login(LoginUserValidator $request)
    {
        $response = $this->authService->loginUser($request->all());

        return Helpers::jsonResponse($response['success'], $response['success'] ? ['token' => $response['token']] : null, $response['message'], $response['success'] ? 200 : 401);
    }

    // تسجيل الخروج
    public function logout()
    {
        $message = $this->authService->logoutUser();
        return Helpers::jsonResponse(true, null, $message);
    }
}