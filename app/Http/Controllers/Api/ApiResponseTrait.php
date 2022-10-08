<?php

namespace App\http\Controllers\Api;
trait ApiResponseTrait
{
    public function api_response($data = null, $message = null, $status = null)
    {
        $array = [
            'data' => $data,
            'message' => $message,
            'status' => $status
        ];
        return response($array, $status);
    }
}
