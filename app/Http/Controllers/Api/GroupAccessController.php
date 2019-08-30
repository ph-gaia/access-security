<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GroupAccess;
use Illuminate\Http\Request;

class GroupAccessController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $groupaccess = GroupAccess::all();
        $body = [
            "message" => "",
            "status" => "success",
            "data" => $groupaccess
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
        $result = GroupAccess::create($request->all());
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
        $groupaccess = GroupAccess::find($id);

        if (!$groupaccess) {
            return response()
                    ->json([
                        "message" => "Group Access not found",
                        "status" => "error",
                        "data" => []
                        ], 404);
        }

        return response()->json([
                "message" => "",
                "status" => "success",
                "data" => $groupaccess
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

        $groupaccess = GroupAccess::find($id);

        if (!$groupaccess) {
            return response()
                    ->json([
                        "message" => "Group Access not found",
                        "status" => "error"
                        ], 404);
        }
        $result = $groupaccess->update($request->all());

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
        $groupaccess = GroupAccess::find($id);

        if (!$groupaccess) {
            return response()
                    ->json([
                        "message" => "Group access not found",
                        "status" => "error"
                        ], 404);
        }

        $groupaccess->delete();
        return response()->json("", 204);
    }
}
