<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = Users::all();

        $body = [
            "message" => "",
            "status" => "success",
            "data" => $users
        ];

        return response()->json($body, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, Response $response)
    {
        $user = new Users();
        return $user->novo($request, $response);
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
        $user = Users::find($id);

        if (!$user) {
            return response()
                    ->json([
                        "message" => "User not found",
                        "status" => "error",
                        "data" => []
                        ], 404);
        }

        return response()->json([
                "message" => "",
                "status" => "success",
                "data" => $user
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
        $user = Users::find($id);
        if (!$user) {
            return response()
                    ->json([
                        "message" => "User not found",
                        "status" => "error"
                        ], 404);
        }
        $result = $user->update($request->all());

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
        $user = Users::find($id);

        if (!$user) {
            return response()
                    ->json([
                        "message" => "User not found",
                        "status" => "error"
                        ], 404);
        }

        $user->delete();
        return response()->json("", 204);
    }
}
