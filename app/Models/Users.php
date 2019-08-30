<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Auth;

class Users extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'area', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function novo(Request $request, Response $response)
    {
        $data = (object) $request->all() ?: [];

        DB::beginTransaction();

        try {
            $entity = new \stdClass();
            $entity->name = $data->name;
            $entity->email = $data->email;
            $entity->phone = $data->phone;
            $entity->area = $data->area;
            $entity->created_at = new \DateTime('now');

            $user = $this->create((array) $entity);

            $datetime = new \DateTime('now');
            $datetime->modify('+3 month');
            $entityAuth = new \stdClass();
            $entityAuth->username = md5($data->username);
            $entityAuth->password = password_hash($data->password, PASSWORD_DEFAULT);
            $entityAuth->validate = $datetime;
            $entityAuth->users_id = $user->id;
            $entityAuth->created_at = new \DateTime('now');
            $entityAuth->updated_at = new \DateTime('now');

            $authModel = new Auth();
            $authModel->create((array) $entityAuth);

            DB::commit();

            return response()->json([
                    "message" => "Registry created successfully",
                    "status" => "success",
                    "data" => $user
                    ], 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                    "message" => $ex->getMessage(),
                    "status" => "error",
                    "data" => ""
                    ], 500);
        }
    }
}
