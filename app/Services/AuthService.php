<?php

namespace App\Services;

use App\Models\User;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use UploadImageTrait; // ✅ تضمين الـ Trait

    /**
     * تسجيل مستخدم جديد
     *
     * @param array $data
     * @return User
     */
    public function registerUser(array $data)
    {
        // ✅ رفع الصور باستخدام الـ Trait
        $identityPath = $this->uploadImage($data['identity_image'], 'identity_images');
        $workPermitPath = $this->uploadImage($data['work_permit_image'], 'work_permits');

        // ✅ إنشاء رمز التحقق
        $verificationCode = rand(100000, 999999);

        // ✅ إنشاء المستخدم
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'profession' => $data['profession'],
            'identity_image' => $identityPath,
            'work_permit_image' => $workPermitPath,
            'password' => Hash::make($data['password']),
            'verification_code' => $verificationCode,
            'verification_code_expires_at' => now()->addMinutes(15),
            'role' => $data['role'], //
        ]);
    }

    /**
     * توثيق الحساب عبر رمز التحقق
     *
     * @param array $data
     * @return string
     */
    public function verifyAccount(array $data)
    {
        $user = User::where('phone', $data['phone'])
            ->where('verification_code', $data['verification_code'])
            ->where('verification_code_expires_at', '>', now())
            ->first();

        if (!$user) {
            return ['success' => false, 'message' => 'رمز التحقق غير صالح أو منتهي الصلاحية.'];
        }

        $user->update([
            'is_verified' => true,
            'verification_code' => null,
            'verification_code_expires_at' => null
        ]);

        return ['success' => true, 'message' => 'تم توثيق الحساب بنجاح. يمكنك الآن تسجيل الدخول.'];
    }

    /**
     * تسجيل الدخول
     *
     * @param array $data
     * @return array
     */
    public function loginUser(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return ['success' => false, 'message' => 'بيانات تسجيل الدخول غير صحيحة.'];
        }

        if (!$user->is_verified) {
            return ['success' => false, 'message' => 'يجب توثيق الحساب قبل تسجيل الدخول.'];
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return ['success' => true, 'token' => $token, 'message' => 'تم تسجيل الدخول بنجاح.'];
    }

    /**
     * تسجيل الخروج
     *
     * @return string
     */
    public function logoutUser()
    {
        Auth::user()->tokens()->delete();
        return 'تم تسجيل الخروج بنجاح.';
    }
}
