<?php

require __DIR__ . '/auth.php';

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HMS\AccountantController;
use App\Http\Controllers\HMS\AdmissionController;
use App\Http\Controllers\HMS\AppointmentController;
use App\Http\Controllers\HMS\BillController;
use App\Http\Controllers\HMS\DepartmentController;
use App\Http\Controllers\HMS\DoctorController;
use App\Http\Controllers\HMS\HospitalInfoController;
use App\Http\Controllers\HMS\LabTestController;
use App\Http\Controllers\HMS\PatientController;
use App\Http\Controllers\HMS\PrescriptionController;
use App\Http\Controllers\HMS\ReceptionistController;



Route::controller(PatientController::class)->group(function () {
    Route::get('/get-patient-list', 'getPatientList');
    Route::get('/patient-prescriptions/{patientId}', 'getPatientPrescriptionsByPatientId')->where('patientId', '[0-9]+');
    
});

Route::controller(ReceptionistController::class)->group(function () {
    Route::get('/view-doctor-list', 'viewDoctorList');
    Route::get('/patient-list', 'viewPatientList');
   
    Route::get('/view-patient-info/{id}', 'viewPatientInfo')->where('id', '[0-9]+');
    Route::get('/view-patient-appointments/{id}', 'viewPatientAppointments')->where('id', '[0-9]+');
    Route::get('/view-patient-appointed-doctors/{id}', 'viewAppointedDoctors')->where('id', '[0-9]+');
    Route::get('/view-patient-prescriptions/{id}', 'viewPatientPrescriptions')->where('id', '[0-9]+');
});

Route::controller(AccountantController::class)->group(function () {
    Route::get('/view-patient-bills/{id}', 'viewPatientBills')->where('id', '[0-9]+');

});

Route::controller(AdmissionController::class)->group(function () {
     Route::post('/admit-new-patient', 'admitNewPatient');
     Route::post('/register-new-patient', 'registerNewPatient');
});


Route::controller(HospitalInfoController::class)->group(function () {
    Route::get('/get-hospital-info', 'getHospitalInfo');
    Route::post('/insert-hospital-info', 'insertHospitalInfo');

    Route::put('/edit-hospital-info/{id}', 'editHospitalInfo')->where('id', '[0-9]+');
    Route::put('/update-hospital-info', 'updateHospitalInfo')->where('id', '[0-9]+');
});





Route::controller(DepartmentController::class)->group(function () {

    Route::get('/retrieve-departments', 'retrieveDepartments');
    Route::post('/add-new-department', 'addNewDepartment');

    Route::put('/update-department/{id}', 'updateDepartment')->where('id', '[0-9]+');
    Route::delete('/delete-department/{id}', 'deleteDepartment')->where('id', '[0-9]+');
});



Route::controller(AppointmentController::class)->group(function () {

    Route::post('/create-appointment', 'createPatientAppointment');
    Route::get('/retrieve-appointments', 'getAllAppointments');
    Route::get('/get-appointment-id/{id}', 'getAppointmentById')->where('id', '[0-9]+');

    Route::put('/update-appointment/{id}', 'updateAppointment')->where('id', '[0-9]+');
    Route::delete('/delete-appointment/{id}', 'deleteAppointment')->where('id', '[0-9]+');
    Route::get('/doctor-appointments/{doctorId}', 'getDoctorAppointments')->where('doctorId', '[0-9]+');
    Route::get('/appointment-created-by/{creatorId}', 'getAppointmentByCreator')->where('creatorId', '[0-9]+');
});




Route::controller(DoctorController::class)->group(function () {

    Route::get('/retrieve-doctors', 'getDoctorList');
    Route::post('/add-new-doctor', 'addNewDoctor');

    Route::put('/update-doctor/{id}', 'updateDoctor')->where('id', '[0-9]+');
    Route::delete('/delete-doctor/{id}', 'deleteDoctor')->where('id', '[0-9]+');
});






Route::controller(LabTestController::class)->group(function () {
    Route::get('/lab-tests', 'getLabTests');
});


Route::controller(BillController::class)->group(function () {
    Route::get('/bills', 'showAllBills');
    Route::get('/bills/patient/{patientId}', 'showBillByPatientId')->where('patientId', '[0-9]+');
});


Route::controller(PrescriptionController::class)->group(function () {
    Route::get('/prescriptions', 'getAllPrescriptions');
    Route::get('/prescriptions/{id}', 'getPrescriptionById')->where('id', '[0-9]+');
    Route::get('/prescriptions/patient/{patientId}', 'getPrescriptionsByPatientId')->where('patientId', '[0-9]+');
    Route::get('/prescriptions/doctor/{doctorId}', 'getPrescriptionsByDoctorId')->where('doctorId', '[0-9]+');
});