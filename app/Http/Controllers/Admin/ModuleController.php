<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Access;
use Session;

class ModuleController extends Controller
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

        $module = Module::all();

        return view('backEnd.admin.module.index', compact('module','userLoggedIn'));
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
        return view('backEnd.admin.module.create', compact('permission','userLoggedIn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'permission']);

        $result = Module::create($request->all());

        if($request->get('permission')) {
            foreach($request->get('permission') as $value) {
                $modulePermission = [
                    "module_id" => $result->id,
                    "permission_id" => $value
                ];
                DB::table('module_has_permission')->insert($modulePermission);
            }
        }

        Session::flash('message', 'Module added!');
        Session::flash('status', 'success');

        return redirect('admin/module');
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

        $module = Module::find($id);
        $permission = Module::select("module_has_permission.*","permission.name AS permission","application.name AS application","application.id AS app_id")
                    ->join("module_has_permission","module_has_permission.module_id","=","module.id")
                    ->join("permission","permission.id","=","module_has_permission.permission_id")
                    ->join("application","application.id","=","permission.application_id")
                    ->where("module.id",$id)
                    ->orderBy('application.name', 'asc')
                    ->get();

        return view('backEnd.admin.module.show', compact('module','permission','userLoggedIn'));
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

        $module = Module::find($id);
        $permissions = Permission::all();
        $permission = Module::select("module_has_permission.*","permission.name AS permission","application.name AS application","application.id AS app_id")
                    ->join("module_has_permission","module_has_permission.module_id","=","module.id")
                    ->join("permission","permission.id","=","module_has_permission.permission_id")
                    ->join("application","application.id","=","permission.application_id")
                    ->where("module.id",$id)
                    ->orderBy('application.name', 'asc')
                    ->get();

        return view('backEnd.admin.module.edit', compact('module','permission','permissions','userLoggedIn'));
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
        $this->validate($request, ['name' => 'required', ]);

        $module = Module::find($id);
        $module->update($request->all());

        if($request->get('permission')) {
            foreach($request->get('permission') as $value) {
                $modulePermission = [
                    "module_id" => $id,
                    "permission_id" => $value
                ];
                DB::table('module_has_permission')->insert($modulePermission);
            }
        }

        Session::flash('message', 'Module updated!');
        Session::flash('status', 'success');

        return redirect('admin/module');
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
        $module = Module::find($id);

        $module->delete();

        Session::flash('message', 'Module deleted!');
        Session::flash('status', 'success');

        return redirect('admin/module');
    }

    public function removeModulePermissionAccess($module, $permission)
    {
        DB::table('module_has_permission')
            ->where('module_id', '=', $module)
            ->where('permission_id', '=', $permission)
            ->delete();

        Session::flash('message', 'Module permission deleted!');
        Session::flash('status', 'success');

        return redirect('admin/module');
    }
}
