<?php

namespace App\Controllers;

use App\Services\ResponseService;
use App\Models\UserModel;

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

        // Send the newly created user back to the user
        ResponseService::Send($newUser);
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
            ResponseService::Send($user); // Successfully authenticated
        } else {
            ResponseService::Send([], 401); // Unauthorized
        }
    }

}
