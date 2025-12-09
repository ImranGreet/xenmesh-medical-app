<?php

use App\Http\Controllers\GlobalAccess\PatientSelfController;
use App\Http\Controllers\GlobalAccess\QRcodeController;
use Illuminate\Support\Facades\Route;

Route::controller(QRcodeController::class)->group(function () {
    Route::get('/generate-patient-card-qrcode/{patientId}', 'generatePatientCardQRCode');
});

Route::controller(PatientSelfController::class)->group(function () {
    Route::get('/view-patient-profile/{patientId}', 'viewPatientProfileByPatientId')->name('patient-public-profile');
});