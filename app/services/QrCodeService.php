<?

namespace App\Services;

use chillerlan\QRCode\QRCode;

class QrCodeService
{
    // initialize env variables
    static function Create($data)
    {
        return (new QRCode)->render($data);
    }

    static function CreateHtmlPreviewImage($data)
    {
        return '<img style="max-width: 500px;" src="' . self::Create($data) . '" alt="QR Code" />';
    }
}
