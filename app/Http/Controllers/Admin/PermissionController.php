<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Helpers\Access;
use Session;

class PermissionController extends Controller
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

        $permission = Permission::select("permission.*", "application.name AS app")
                    ->join("application","application.id","=","permission.application_id")
                    ->get();

        return view('backEnd.admin.permission.index', compact('permission','userLoggedIn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $userLoggedIn = $this->access->authenticAccess([1, 2]);

        $application = Application::all();
        return view('backEnd.admin.permission.create', compact('application','userLoggedIn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        Permission::create($request->all());

        Session::flash('message', 'Permission added!');
        Session::flash('status', 'success');

        return redirect('admin/permission');
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

        $permission = Permission::select("permission.*", "application.name AS app")
                    ->join("application","application.id","=","permission.application_id")
                    ->where("permission.id","=",$id)->first();

        return view('backEnd.admin.permission.show', compact('permission','userLoggedIn'));
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

        $permission = Permission::findOrFail($id);
        $application = Application::all();

        return view('backEnd.admin.permission.edit', compact('permission','application','userLoggedIn'));
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

        $permission = Permission::findOrFail($id);
        $permission->update($request->all());

        Session::flash('message', 'Permission updated!');
        Session::flash('status', 'success');

        return redirect('admin/permission');
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
        $permission = Permission::findOrFail($id);

        $permission->delete();

        Session::flash('message', 'Permission deleted!');
        Session::flash('status', 'success');

        return redirect('admin/permission');
    }

}
