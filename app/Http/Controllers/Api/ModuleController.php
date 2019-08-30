<?php
namespace App\Http\Controllers\Api;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $module = Module::all();

        $body = [
            "message" => "",
            "status" => "success",
            "data" => $module
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
        $result = Module::create($request->all());

        $body = [
            "message" => "Registry created successfully",
            "status" => "success",
            "data" => $result
        ];
        return response()->json($body, 201);
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
        $module = Module::find($id);

        if (!$module) {
            return response()
                    ->json([
                        "message" => "Module not found",
                        "status" => "error",
                        "data" => []
                        ], 404);
        }

        return response()->json([
                "message" => "",
                "status" => "success",
                "data" => $module
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

        $module = Module::find($id);

        if (!$module) {
            return response()
                    ->json([
                        "message" => "Module not found",
                        "status" => "error"
                        ], 404);
        }
        $result = $module->update($request->all());

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
        $module = Module::find($id);

        if (!$module) {
            return response()
                    ->json([
                        "message" => "Module not found",
                        "status" => "error"
                        ], 404);
        }

        $module->delete();
        return response()->json("", 204);
    }
}
