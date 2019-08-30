<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Helpers\Access;
use Session;

class ApplicationController extends Controller
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

        $application = Application::all();

        return view('backEnd.admin.application.index', compact('application','userLoggedIn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $userLoggedIn = $this->access->authenticAccess([1, 2]);

        return view('backEnd.admin.application.create', compact('userLoggedIn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    { 
        Application::create($request->all());

        Session::flash('message', 'Application added!');
        Session::flash('status', 'success');

        return redirect('admin/application');
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

        $application = Application::find($id);

        return view('backEnd.admin.application.show', compact('application', 'userLoggedIn'));
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

        $application = Application::find($id);

        return view('backEnd.admin.application.edit', compact('application', 'userLoggedIn'));
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
        
        $application = Application::find($id);
        $application->update($request->all());

        Session::flash('message', 'Application updated!');
        Session::flash('status', 'success');

        return redirect('admin/application');
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
        $application = Application::find($id);

        $application->delete();

        Session::flash('message', 'Application deleted!');
        Session::flash('status', 'success');

        return redirect('admin/application');
    }

}
