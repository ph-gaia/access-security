<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $auth = new Auth();
        return $auth->login($request);
    }

    public function verify(Request $request)
    {
        $auth = new Auth();
        return $auth->verifyAccess($request);
    }
}
