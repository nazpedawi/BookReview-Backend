<?

namespace App\Services;

class EnvService
{
    // initialize env variables
    static function Init()
    {
        // database
        $_ENV["DB_HOST"] = "mysql";
        $_ENV["DB_NAME"] = "WebDevelopment2DB";
        $_ENV["DB_USER"] = "user";
        $_ENV["DB_PASSWORD"] = "password";
        $_ENV["DB_CHARSET"] = "utf8mb4";
        // env flag
        $_ENV["ENV"] = "LOCAL";
        $_ENV["JWT_SECRET"] = "8RXVjZIyszZEZSyb6h2C6xdNnH3FD2eh";
    }
}
