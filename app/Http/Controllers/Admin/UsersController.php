<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\GroupAccess;
use App\Models\Module;
use App\Helpers\Access;

class UsersController extends Controller
{
    function __construct()
    {
        $this->access = new Access();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $userLoggedIn = $this->access->authenticAccess([1, 2]);

        $users = User::all();

        return view('backEnd.admin.users.index', compact('users', 'userLoggedIn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $userLoggedIn = $this->access->authenticAccess([1, 2]);
        return view('backEnd.admin.users.create', compact('userLoggedIn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required', ]);

        User::create($request->all());

        Session::flash('message', 'User added!');
        Session::flash('status', 'success');

        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userLoggedIn = $this->access->authenticAccess([1, 2]);
        $user = User::find($id);
        $permissions = User::select("users_has_permission.*","permission.name AS permission","application.name AS application","application.id AS app_id")
                    ->join("users_has_permission","users_has_permission.users_id","=","users.id")
                    ->join("permission","permission.id","=","users_has_permission.permission_id")
                    ->join("application","application.id","=","permission.application_id")
                    ->where("users.id",$id)
                    ->orderBy('application.name', 'asc')
                    ->get();

        return view('backEnd.admin.users.show', compact('user','permissions','userLoggedIn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userLoggedIn = $this->access->authenticAccess([1, 2]);
        $user = User::find($id);
        $module = Module::all();
        $groupAccess = GroupAccess::all();
        $permission = Permission::all();
        $permissions = User::select("users_has_permission.*","permission.name AS permission","application.name AS application","application.id AS app_id")
                    ->join("users_has_permission","users_has_permission.users_id","=","users.id")
                    ->join("permission","permission.id","=","users_has_permission.permission_id")
                    ->join("application","application.id","=","permission.application_id")
                    ->where("users.id",$id)
                    ->orderBy('application.name', 'asc')
                    ->get();

        return view('backEnd.admin.users.edit', compact('user','permission','permissions','groupAccess','module','userLoggedIn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required', ]);

        $permissionUsers = $this->makeArrayUserPermission($request);

        $user = User::find($id);
        $user->update($request->all());

        if (!empty($permissionUsers)) {
            foreach($permissionUsers as $value) {
                $modulePermission = [
                    "users_id" => $id,
                    "permission_id" => $value
                ];
                DB::table('users_has_permission')->insert($modulePermission);
            }
        }

        Session::flash('message', 'User updated!');
        Session::flash('status', 'success');

        return redirect('admin/users');
    }

    private function makeArrayUserPermission(Request $request)
    {
        $permissionUsers = [];
        $groupAccess = $request->get('group_access');
        $module = $request->get('module');
        $permission = $request->get('permission');

        if ($groupAccess) {
            foreach($groupAccess as $value) {
                $gpAccess = DB::table('group_access_has_permission')->where('group_access_id', '=', $value)->get();

                foreach($gpAccess as $value) {
                    $permissionUsers[] = $value->permission_id;
                }
            }
        }

        if ($module) {
            foreach($module as $value) {
                $permissionModule = DB::table('module_has_permission')->where('module_id', '=', $value)->get();

                foreach($permissionModule as $value) {
                    $permissionUsers[] = $value->permission_id;
                }
            }
        }

        if ($permission) {
            foreach($permission as $value) {
                $permissionUsers[] = $value;
            }
        }

        return array_unique($permissionUsers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        Session::flash('message', 'User deleted!');
        Session::flash('status', 'success');

        return redirect('admin/users');
    }

    public function removeUserPermissionAccess($user, $permission)
    {
        DB::table('users_has_permission')
            ->where('users_id', '=', $user)
            ->where('permission_id', '=', $permission)
            ->delete();

        Session::flash('message', 'User permission deleted!');
        Session::flash('status', 'success');

        return redirect('admin/users');
    }
}
