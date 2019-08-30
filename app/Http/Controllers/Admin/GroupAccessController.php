<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupAccess;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Access;
use Session;

class GroupAccessController extends Controller
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

        $groupaccess = GroupAccess::all();

        return view('backEnd.admin.groupaccess.index', compact('groupaccess','userLoggedIn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $userLoggedIn = $this->access->authenticAccess([1, 2]);

        $permission = Permission::all();
        return view('backEnd.admin.groupaccess.create', compact('permission','userLoggedIn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required','permission']);

        $result = GroupAccess::create($request->all());

        foreach($request->get('permission') as $value) {
            $gpPermission = [
                "group_access_id" => $result->id,
                "permission_id" => $value
            ];
        }

        DB::table('group_access_has_permission')->insert($gpPermission);

        Session::flash('message', 'GroupAccess added!');
        Session::flash('status', 'success');

        return redirect('admin/groupaccess');
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

        $groupaccess = GroupAccess::find($id);
        $permission = GroupAccess::select("group_access_has_permission.*","permission.name AS permission","application.name AS application","application.id AS app_id")
                    ->join("group_access_has_permission","group_access_has_permission.group_access_id","=","group_access.id")
                    ->join("permission","permission.id","=","group_access_has_permission.permission_id")
                    ->join("application","application.id","=","permission.application_id")
                    ->where("group_access.id",$id)
                    ->orderBy('application.name', 'asc')
                    ->get();

        return view('backEnd.admin.groupaccess.show', compact('groupaccess','permission','userLoggedIn'));
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

        $result = GroupAccess::find($id);
        $groupaccess = GroupAccess::select("group_access_has_permission.*","permission.name AS permission","application.name AS application","application.id AS app_id")
                    ->join("group_access_has_permission","group_access_has_permission.group_access_id","=","group_access.id")
                    ->join("permission","permission.id","=","group_access_has_permission.permission_id")
                    ->join("application","application.id","=","permission.application_id")
                    ->where("group_access.id",$id)
                    ->orderBy('application.name', 'asc')
                    ->get();

        $permission = Permission::all();

        return view('backEnd.admin.groupaccess.edit', compact('result', 'groupaccess', 'permission','userLoggedIn'));
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
        $this->validate($request, ['name' => 'required']);

        $groupaccess = GroupAccess::find($id);
        $groupaccess->update($request->all());

        if($request->get('permission')) {
            foreach($request->get('permission') as $value) {
                $gpPermission = [
                    "group_access_id" => $id,
                    "permission_id" => $value
                ];
                DB::table('group_access_has_permission')->insert($gpPermission);
            }
        }

        Session::flash('message', 'GroupAccess updated!');
        Session::flash('status', 'success');

        return redirect('admin/groupaccess');
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
        $groupaccess = GroupAccess::find($id);

        $groupaccess->delete();

        Session::flash('message', 'GroupAccess deleted!');
        Session::flash('status', 'success');

        return redirect('admin/groupaccess');
    }

    public function removeGpPermissionAccess($group_access, $permission)
    {
        DB::table('group_access_has_permission')
            ->where('group_access_id', '=', $group_access)
            ->where('permission_id', '=', $permission)
            ->delete();

        Session::flash('message', 'GroupAccess deleted!');
        Session::flash('status', 'success');

        return redirect('admin/groupaccess');
    }
}
