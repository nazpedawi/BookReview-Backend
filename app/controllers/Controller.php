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

    function decodePostData()
{
    // Check if the request is JSON (Content-Type: application/json)
    if (isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
        $json = file_get_contents("php://input");
        return json_decode($json, true) ?? [];
    }

    // Otherwise, assume it's form data (Content-Type: multipart/form-data) for POST requests
    return $_POST;
}



}
