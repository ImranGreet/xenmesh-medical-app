<?php

use App\Http\Controllers\Auth\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    $users = User::all();
    return response()->json([
        "message" => "Message successfull",
        "users" => $users,
    ]);
})->middleware('auth:sanctum');




Route::controller(AuthController::class)->group(function () {
    Route::post('/register-hospital-member', 'registerHospitalMember');
});
