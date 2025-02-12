<?

namespace App\Services;

class ResponseService
{
    // send a JSON response with appropriate header and status
    static function Send($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit();
    }

    // send JSON error response with status
    static function Error($error = "An error occurred", $status = 500)
    {
        self::Send(["error" => $error], $status);
    }
}
