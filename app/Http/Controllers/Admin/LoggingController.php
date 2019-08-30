<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Logging;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class LoggingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $logging = Logging::all();

        return view('backEnd.admin.logging.index', compact('logging'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.admin.logging.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['description' => 'required', ]);

        Logging::create($request->all());

        Session::flash('message', 'Logging added!');
        Session::flash('status', 'success');

        return redirect('admin/logging');
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
        $logging = Logging::findOrFail($id);

        return view('backEnd.admin.logging.show', compact('logging'));
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
        $logging = Logging::findOrFail($id);

        return view('backEnd.admin.logging.edit', compact('logging'));
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
        $this->validate($request, ['description' => 'required', ]);

        $logging = Logging::findOrFail($id);
        $logging->update($request->all());

        Session::flash('message', 'Logging updated!');
        Session::flash('status', 'success');

        return redirect('admin/logging');
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
        $logging = Logging::findOrFail($id);

        $logging->delete();

        Session::flash('message', 'Logging deleted!');
        Session::flash('status', 'success');

        return redirect('admin/logging');
    }

}
