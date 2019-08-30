<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\Access;
use Session;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->access = new Access();
    }

    public function index()
    {
        $userLoggedIn = $this->access->authenticAccess([1, 2]);

        $apps = DB::table('users_has_permission AS A')
            ->join('permission AS B', 'B.id', '=', 'A.permission_id')
            ->join('users AS C', 'C.id', '=', 'A.users_id')
            ->join('application AS D', 'D.id', '=', 'B.application_id')
            ->select('D.id', 'D.image', 'D.name', 'D.url_base')
            ->where('A.users_id', $userLoggedIn->id)
            ->groupBy('D.id', 'D.image', 'D.name', 'D.url_base')
            ->get();

        return view('backEnd.admin.dashboard.index', compact('userLoggedIn', 'apps'));
    }
}
