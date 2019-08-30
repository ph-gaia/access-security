<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auth;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('backEnd.admin.auth.login');
    }

    public function autentica(Request $request)
    {
        $auth = new Auth();
        $auth->loginInterno($request);
    }

    public function logout(Request $request)
    {
        $request->session()->forget("tokenApp","userId");
        Session::flash('status', 'success');

        return redirect('admin/login');
    }
}
