<?php
namespace App\Http\Controllers\Api;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{

    /**
     * listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $application = Application::all();

        $body = [
            "message" => "",
            "status" => "success",
            "data" => $application
        ];

        return response()->json($body, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $result = Application::create($request->all());
        $body = [
            "message" => "",
            "status" => "success",
            "data" => $result
        ];
        return response()->json($body, 201);
    }

    /**
     * specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $application = Application::find($id);

        if (!$application) {
            return response()
                    ->json([
                        "message" => "Application not found",
                        "status" => "error",
                        "data" => []
                        ], 404);
        }

        return response()->json([
                "message" => "",
                "status" => "success",
                "data" => $application
                ], 200);
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
        if (!$application) {
            return response()
                    ->json([
                        "message" => "Application not found",
                        "status" => "error"
                        ], 404);
        }
        $result = $application->update($request->all());

        return response()->json([
                "message" => "Registry updated successfully",
                "status" => "success",
                "data" => $result
                ], 200);
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
        if (!$application) {
            return response()
                    ->json([
                        "message" => "Application not found",
                        "status" => "error"
                        ], 404);
        }

        $application->delete();
        return response()->json("", 204);
    }
}
