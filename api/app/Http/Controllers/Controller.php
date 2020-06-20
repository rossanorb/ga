<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    protected $response = [
        'status' => false,
        'result' =>  '',
        'errors' => []
    ];

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($http_status = 200 ) {
        return response()->json($this->response, $http_status, [JSON_HEX_QUOT, JSON_HEX_TAG])->header('Content-Type', 'application/json; charset=UTF8');
    }
}
