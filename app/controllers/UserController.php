<?php

namespace App\Controllers;

use App\Services\ResponseService;
use App\Models\UserModel;
use Firebase\JWT\JWT;

class UserController extends Controller
{
    private $userModel;

    function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Create a new user
     */
    function create()
    {
        // Get data from $_POST request
        $data = $this->decodePostData();

        // Validate input (ensure necessary fields are present)
        $this->validateInput(["firstName", "lastName", "username", "password", "email"], $data);

        // Save to DB
        $newUser = $this->userModel->create($data);

        ResponseService::Send(["success" => true, "message" => "User created successfully."]);
    }

    /**
     * Authenticate a user
     */
    function authenticate()
    {
        // Get data from the request
        $data = $this->decodePostData();

        // Validate input (ensure necessary fields are present)
        $this->validateInput(["username", "password"], $data);

        // Authenticate the user
        $user = $this->userModel->authenticate($data['username'], $data['password']);

        if ($user) {
            $token = $this->generateJWT($user);
            ResponseService::Send(['token' => $token, 'user' => $user]);
        } else {
            ResponseService::Error('Invalid username or password, Please try again', 401);
        }
    }

    private function generateJWT($user)
    {
        $issuedAt = time();
        $expire = $issuedAt + 3600 * 4; // 4 hours

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expire,
            'user' => [
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'role' => $user['role']
            ]
        ];

        return JWT::encode($payload, $_ENV["JWT_SECRET"], 'HS256');
    }

    public function me()
    {
        ResponseService::Send($this->getAuthenticatedUser());
    }
}
