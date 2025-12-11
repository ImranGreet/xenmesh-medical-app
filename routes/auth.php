<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RolePermissionController;
use App\Http\Controllers\QR\QRcodeController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {

    Route::post('/register-hospital-member', 'registerHospitalMember');
    Route::post('/login-hospital-member', 'loginHospitalMember');
    
});

Route::controller(RolePermissionController::class)->middleware('auth:sanctum')->group(function () {

    Route::get('/get-all-roles', 'getAllRoles');
    Route::post('/create-a-role', 'addNewRole');

    route::post('/edit-permission/{id}', 'editPermission')->where('id', '[0-9]+');
    route::delete('/remove-permission/{id}', 'removePermission')->where('id', '[0-9]+');

    Route::get('/get-all-permissions', 'getAllPermissions');
    Route::post('/add-new-permisson', 'addNewPermission');

    Route::post('/edit-permisson/{id}', 'addNewPermission')->where('id', '[0-9]+');
    Route::delete('/remove-permisson/{id}', 'removePermission')->where('id', '[0-9]+');
});


