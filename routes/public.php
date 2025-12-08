<?php

use App\Http\Controllers\Public\QRcodeController;
use Illuminate\Support\Facades\Route;

Route::controller(QRcodeController::class)->group(function () {
    
    Route::get('/qrcode/generate', 'generateQRCode')->name('qrcode.generate');
});
