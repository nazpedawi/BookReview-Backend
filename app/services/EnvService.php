<?

namespace App\Services;

class EnvService
{
    // initialize env variables
    static function Init()
    {
        // database
        $_ENV["DB_HOST"] = "mysql";
        $_ENV["DB_NAME"] = "developmentdb";
        $_ENV["DB_USER"] = "user";
        $_ENV["DB_PASSWORD"] = "password";
        $_ENV["DB_CHARSET"] = "utf8mb4";
        // env flag
        $_ENV["ENV"] = "LOCAL";
    }
}
