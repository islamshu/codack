<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{

    public function sendResponse($status)
    {
        $response = ['status' => true, 'HTTP_code' => 200, 'HTTP_response' => $status];
        return $response;
    }

    public function SendError($message)
    {
        $response = ['status' => false, 'HTTP_code' => 404, 'HTTP_response' => $message];

        return $response;
    }
}
