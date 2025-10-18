<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RolePermissionController;
use App\Http\Controllers\HMS\AppointmentController;
use App\Http\Controllers\HMS\DepartmentController;
use App\Http\Controllers\HMS\DoctorController;
use App\Http\Controllers\HMS\HospitalInfoController;
use App\Http\Controllers\HMS\ReceptionistController;
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


Route::controller(ReceptionistController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/view-doctor-list', 'viewDoctorList');

    Route::post('/register-new-patient', 'registerNewPatient');
    Route::post('/admit-new-patient', 'admitNewPatient');
    Route::get('/view-patient-info/{id}', 'viewPatientInfo')->where('id', '[0-9]+');
    Route::get('/view-doctorlist', 'viewDoctorList');
    Route::get('/patient-list', 'viewPatientList');
});


Route::controller(HospitalInfoController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/get-hospital-info', 'getHospitalInfo');
    Route::post('/insert-hospital-info', 'insertHospitalInfo');

    Route::put('/edit-hospital-info/{id}', 'editHospitalInfo')->where('id', '[0-9]+');
    Route::put('/update-hospital-info', 'updateHospitalInfo')->where('id', '[0-9]+');
});





Route::controller(DepartmentController::class)->middleware('auth:sanctum')->group(function () {

    Route::get('/retrieve-departments', 'retrieveDepartments');
    Route::post('/add-new-department', 'addNewDepartment');
    Route::put('/update-department/{id}', 'updateDepartment')->where('id', '[0-9]+');
    Route::delete('/delete-department/{id}', 'deleteDepartment')->where('id', '[0-9]+');
});



Route::controller(AppointmentController::class)->middleware('auth:sanctum')->group(function () {

    Route::post('/create-appointment', 'createPatientAppointment');
    Route::get('/retrieve-appointments', 'getAllAppointments');
    Route::get('/get-appointment/{id}', 'getAppointment')->where('id', '[0-9]+');
    Route::put('/update-appointment/{id}', 'updateAppointment')->where('id', '[0-9]+');
    Route::delete('/delete-appointment/{id}', 'deleteAppointment')->where('id', '[0-9]+');
    Route::get('/doctor-appointments/{doctorId}', 'getDoctorAppointments')->where('doctorId', '[0-9]+');
});




Route::controller(DoctorController::class)->middleware('auth:sanctum')->group(function () {

    Route::get('/retrieve-doctors', 'getDoctorList');
    Route::post('/add-new-doctor', 'addNewDoctor');
    Route::put('/update-doctor/{id}', 'updateDoctor')->where('id', '[0-9]+');
    Route::delete('/delete-doctor/{id}', 'deleteDoctor')->where('id', '[0-9]+');
    
});
