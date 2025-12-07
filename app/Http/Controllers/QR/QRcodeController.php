<?php

namespace App\Http\Controllers\QR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRcodeController extends Controller
{
    public function generateQRCode()
    {
        return QrCode::size(300)->generate('https://www.facebook.com/imran.hossain.576239/');
    }
}
