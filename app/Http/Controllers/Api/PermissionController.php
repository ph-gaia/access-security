<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $permission = permission::all();

        $body = [
            "message" => "",
            "status" => "success",
            "data" => $permission
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
        $result = permission::create($request->all());

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
        $permission = permission::find($id);

        if (!$permission) {
            return response()
                    ->json([
                        "message" => "Permission not found",
                        "status" => "error",
                        "data" => []
                        ], 404);
        }

        return response()->json([
                "message" => "",
                "status" => "success",
                "data" => $permission
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
        $permission = permission::find($id);
        if (!$permission) {
            return response()
                    ->json([
                        "message" => "Module not found",
                        "status" => "error"
                        ], 404);
        }
        $result = $permission->update($request->all());

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
        $permission = permission::find($id);

        if (!$permission) {
            return response()
                    ->json([
                        "message" => "Permission not found",
                        "status" => "error"
                        ], 404);
        }

        $permission->delete();
        return response()->json("", 204);
    }
}
