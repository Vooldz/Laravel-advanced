<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    // Return json response with the data, status, and status code
    public function successResponse($response, $status = "Success", $code = 200){
        return response()->json(['data' => $response,'status'=> $status], $code);
    }
}
