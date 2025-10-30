<?php

require __DIR__ . '/auth.php';



use App\Http\Controllers\HMS\DischargeSummaryController;
use App\Http\Controllers\HMS\FloorController;
use App\Http\Controllers\HMS\PaymentController;
use App\Http\Controllers\HMS\PharmacistController;
use App\Http\Controllers\HMS\SalaryController;
use App\Http\Controllers\HMS\ShiftController;
use App\Http\Controllers\HMS\AccountantController;
use App\Http\Controllers\HMS\AdmissionController;
use App\Http\Controllers\HMS\AppointmentController;
use App\Http\Controllers\HMS\AttendanceController;
use App\Http\Controllers\HMS\BillController;
use App\Http\Controllers\HMS\DepartmentController;
use App\Http\Controllers\HMS\DoctorController;
use App\Http\Controllers\HMS\DoctorScheduleController;
use App\Http\Controllers\HMS\EquipmentController;
use App\Http\Controllers\HMS\ExpenseController;
use App\Http\Controllers\HMS\HospitalInfoController;
use App\Http\Controllers\HMS\LabTestController;
use App\Http\Controllers\HMS\LeaveRequestController;
use App\Http\Controllers\HMS\PatientController;
use App\Http\Controllers\HMS\PrescriptionController;
use App\Http\Controllers\HMS\ReceptionistController;



use Illuminate\Support\Facades\Route;


Route::controller(PatientController::class)->group(function () {
    Route::get('/get-patient-list', 'getPatientList');
    Route::get('/patient-prescriptions/{patientId}', 'getPatientPrescriptionsByPatientId')->where('patientId', '[0-9]+');
});


Route::controller(AdmissionController::class)->group(function () {
    Route::post('/admit-new-patient', 'admitNewPatient');
    Route::post('/register-new-patient', 'registerNewPatient');
});

Route::controller(ReceptionistController::class)->group(function () {
    Route::get('/view-doctor-list', 'viewDoctorList');
    Route::get('/patient-list', 'viewPatientList');
    Route::get('/view-patient-info/{id}', 'viewPatientInfo')->where('id', '[0-9]+');
    Route::get('/view-patient-appointments/{id}', 'viewPatientAppointments')->where('id', '[0-9]+');
    Route::get('/view-patient-appointed-doctors/{id}', 'viewAppointedDoctors')->where('id', '[0-9]+');
    Route::get('/view-patient-prescriptions/{id}', 'viewPatientPrescriptions')->where('id', '[0-9]+');
});








Route::controller(AppointmentController::class)->group(function () {

    Route::post('/create-appointment', 'createPatientAppointment');
    Route::get('/retrieve-appointments', 'getAllAppointments');
    Route::get('retrieve-appointments/status/{status}', 'getAllAppointmentsByStatus')->where('status', '[A-Za-z]+');
    Route::get('retrieve-appointments/doctor/{doctorId}', 'getAllAppointmentsByDoctorId')->where('doctorId', '[0-9]+');

    Route::get('/get-appointment-id/{id}', 'getAppointmentById')->where('id', '[0-9]+');

    Route::put('/update-appointment/{id}', 'updateAppointment')->where('id', '[0-9]+');
    Route::delete('/delete-appointment/{id}', 'deleteAppointment')->where('id', '[0-9]+');

    Route::get('/doctor-appointments/{doctorId}', 'getDoctorAppointments')->where('doctorId', '[0-9]+');
    Route::get('/appointment-created-by/{creatorId}', 'getAppointmentByCreator')->where('creatorId', '[0-9]+');

    Route::get('/appointments/date/{date}', 'getAppointmentsByDate')->where('date', '\d{4}-\d{2}-\d{2}');

    Route::get('/appointments/date-range', 'getAppointmentsByDateRange');
    // filter criteria
    Route::get('/appointments/filter', 'filterAppointments');
});





Route::controller(DoctorController::class)->group(function () {

    Route::get('/retrieve-doctors', 'getDoctorList');
    Route::get('/retrieve-doctors/department/{department_id}', 'retriveDoctorListByDepartment')->where('department_id', '[0-9]+');
    Route::post('/add-new-doctor', 'addNewDoctor');

    Route::put('/update-doctor/{id}', 'updateDoctor')->where('id', '[0-9]+');
    Route::delete('/delete-doctor/{id}', 'deleteDoctor')->where('id', '[0-9]+');
});








Route::controller(PharmacistController::class)->group(function () {
    Route::get('', '');
});














Route::controller(AccountantController::class)->group(function () {
    Route::get('/view-patient-bills/{id}', 'viewPatientBills')->where('id', '[0-9]+');
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

/*this route is defined only logic on controller nor defined*/
Route::controller(DischargeSummaryController::class)->group(function () {});

Route::controller(DoctorScheduleController::class)->group(function () {});

/*
1.routes are defined only in routes file not in controller for which routes are need to complete to luanch this services.
2. May need more focus to complete this services or controller
*/

Route::controller(AttendanceController::class)->group(function () {});

Route::controller(ShiftController::class)->group(function () {
    Route::get('/shifts', 'getAllShifts');
    Route::post('/shifts', 'createShift');
    Route::put('/shifts/{id}', 'updateShift')->where('id', '[0-9]+');
    Route::delete('/shifts/{id}', 'deleteShift')->where('id', '[0-9]+');
});


Route::controller(FloorController::class)->group(function () {
    Route::get('/floors', 'getAllFloors');
    Route::post('/floors', 'createFloor');
    Route::put('/floors/{id}', 'updateFloor')->where('id', '[0-9]+');
    Route::delete('/floors/{id}', 'deleteFloor')->where('id', '[0-9]+');
});



Route::controller(LeaveRequestController::class)->group(function () {
    Route::get('/leave-requests', 'getAllLeaveRequests');
    Route::post('/leave-requests', 'createLeaveRequest');
    Route::put('/leave-requests/{id}', 'updateLeaveRequest')->where('id', '[0-9]+');
    Route::delete('/leave-requests/{id}', 'deleteLeaveRequest')->where('id', '[0-9]+');
});

Route::controller(ExpenseController::class)->group(function () {
    Route::get('/expenses', 'getAllExpenses');
    Route::post('/expenses', 'createExpense');
    Route::put('/expenses/{id}', 'updateExpense')->where('id', '[0-9]+');
    Route::delete('/expenses/{id}', 'deleteExpense')->where('id', '[0-9]+');
});


Route::controller(EquipmentController::class)->group(function () {
    Route::get('/equipments', 'getAllEquipments');
    Route::post('/equipments', 'createEquipment');
    Route::put('/equipments/{id}', 'updateEquipment')->where('id', '[0-9]+');
    Route::delete('/equipments/{id}', 'deleteEquipment')->where('id', '[0-9]+');
});

Route::controller(PaymentController::class)->group(function () {
    Route::get('/payments', 'getAllPayments');
    Route::post('/payments', 'createPayment');
    Route::put('/payments/{id}', 'updatePayment')->where('id', '[0-9]+');
    Route::delete('/payments/{id}', 'deletePayment')->where('id', '[0-9]+');
});


Route::controller(SalaryController::class)->group(function () {
    Route::get('/salaries', 'getAllSalaries');
    Route::post('/salaries', 'createSalary');
    Route::put('/salaries/{id}', 'updateSalary')->where('id', '[0-9]+');
    Route::delete('/salaries/{id}', 'deleteSalary')->where('id', '[0-9]+');
});
