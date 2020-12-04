<?php

namespace App\Http\Controllers\Api;
use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request) {
        User::create($request->getAttributes())->sendEmailVerificationNotification;

        return $this->respondWithMessage('User successfully created');
    }
}
