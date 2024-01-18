<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\V1\BaseController;
use App\Mail\UserEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends BaseController
{
    public function sendEmail()
    {
        Mail::to(auth()->user()->email)->send(new UserEmail());
        return $this->successResponse("Email successfully sended!");
    }   
}
