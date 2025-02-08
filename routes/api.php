<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SupervisorController;
use App\Http\Controllers\Api\EngineerController;
use App\Http\Controllers\Api\ContractorController;




Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/verify', [AuthController::class, 'verifyAccount']);
Route::post('auth/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    

    // المسار الذي يعيد المستخدم المصادق عليه
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    Route::post('auth/logout', [AuthController::class, 'logout']);
    
Route::apiResource('employees', EmployeeController::class);
Route::apiResource('Supervisor', SupervisorController::class);
Route::apiResource('Engineer', EngineerController::class);
Route::apiResource('Contractor', ContractorController::class);
});
