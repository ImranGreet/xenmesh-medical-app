<?php
namespace App\Services\Public;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRcodeGenerator
{
    public function generateSVG($url)
    {
        $svg = QrCode::format('svg')->size(300)->generate($url);
        $base64Svg = base64_encode($svg);
        return $base64Svg;
    }
}
