<?php

namespace App\Http\Controllers;

use App\Service\Authenticator;
use Illuminate\Http\Request;

class CustomAuthenticationController extends Controller
{
    public function getToken(Request $request)
    {
        return (new Authenticator())->authenticate($request->email, $request->password);
    }
}
