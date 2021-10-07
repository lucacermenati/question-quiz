<?php

namespace App\Http\Controllers;

use App\Enum\HttpStatusCode;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $response;

    public function setResponseSucceeded($content = [])
    {
        $content['success'] = true;
        $this->response = response($content, HttpStatusCode::SUCCESS);
    }

    public function setResponseFailed($message, $statusCode)
    {
        $this->response = response([
            "success" => false,
            "message" => $message,
        ], $statusCode);
    }
}
