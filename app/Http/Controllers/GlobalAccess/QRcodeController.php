<?php

namespace App\Http\Controllers\GlobalAccess;

use App\Http\Controllers\Controller;
use App\Services\GlobalAccess\QRcodeGenerator;
use Illuminate\Http\Request;

class QRcodeController extends Controller
{
    protected $qrCodeGenerator;
    public function __construct(QRcodeGenerator $qrCodeGenerator)
    {
        $this->qrCodeGenerator = $qrCodeGenerator;
    }


    public function generatePatientCardQRCode($patientId)
    {
        $patientPublicRoute = route('patient-public-profile', ['patientId' => $patientId]);

        return response()->json([
            'status' => 'success',
            'qr_code_svg' => 'data:image/svg+xml;base64,' . $this->qrCodeGenerator->generateSVG($patientPublicRoute),
            'text' => $patientPublicRoute
        ]);
    }
}
