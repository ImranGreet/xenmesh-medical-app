<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\Public\QRcodeGenerator;
use Illuminate\Http\Request;

class QRcodeController extends Controller
{
    protected $qrCodeGenerator;

    public function __construct(QRcodeGenerator $qrCodeGenerator) 
    {
        $this->qrCodeGenerator = $qrCodeGenerator;
    }

    public function generateQRCode()
    {
        $url = 'https://www.facebook.com/imran.hossain.576239/';

        return response()->json([
            'status' => 'success',
            'qr_code_svg' => 'data:image/svg+xml;base64,' . $this->qrCodeGenerator->generateSVG($url),
            'text' => $url
        ]);
    }

    public function generatePatientCardQRCode(){
        $url = 'https://www.facebook.com/imran.hossain.576239/';

        return response()->json([
            'status' => 'success',
            'qr_code_svg' => 'data:image/svg+xml;base64,' . $this->qrCodeGenerator->generateSVG($url),
            'text' => $url
        ]);
    }
}
