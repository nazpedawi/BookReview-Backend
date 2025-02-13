<?php

// base controller, this is a good place to put shared functionality like authentication/authorization, validation, etc

namespace App\Controllers;

use App\Services\ResponseService;

class Controller
{

    // ensures all expected fields are set in data object and sends a bad request response if not
    // used to make sure all expected $_POST fields are at least set, additional validation may still need to be set
    function validateInput($expectedFields, $data)
    {
        foreach ($expectedFields as $field) {
            if (!isset($data[$field])) {
                ResponseService::Send("Required field: $field, is missing", 400);
                exit();
            }
        }
    }

    // gets the post data and returns it as an array
    function decodePostData()
    {
        try {
            return json_decode(file_get_contents('php://input'), true);
        } catch (\Throwable $th) {
            ResponseService::Error("error decoding JSON in request body", 400);
        }
    }
}
