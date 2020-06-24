<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class ApiService {

    protected $response = [
        'status' => false,
        'result' =>  '',
        'errors' => []
    ];

    public function setStatus(bool $status): void
    {
        $this->response['status'] = $status;
    }

    public function setResult($result): void
    {
        $this->response['result'] = $result;
    }

    public function setErrors($errors): void
    {
        $this->response['errors'] = $errors;
    }

    public function response($http_status = 200 ) {
        return response()->json($this->response, $http_status, [JSON_HEX_QUOT, JSON_HEX_TAG])->header('Content-Type', 'application/json; charset=UTF8');
    }
}