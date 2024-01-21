<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Support\Facades\Http;

class ThirdPartyController extends BaseController
{
    public function index()
    {
        $response = Http::get("https://hawyatshipping.com/api/get-ports/Sea-533");
        return $this->successResponse($response->json(),);
    }
}
