<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Helpers\Authenticator;
use Illuminate\Support\Facades\DB;
use App\Helpers\Session;
use App\Helpers\Mensagem as msg;

class Auth extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'authentication';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password', 'validate', 'active', 'created_at', 'updated_at', 'users_id'];
    public $timestamps = false;

    public function login(Request $request)
    {
        $data = (object) $request->all() ?: [];

        try {
            $entity = $this->join("users", "users.id", '=', "authentication.users_id")
                ->where('username', md5($data->username))->first();

            if (
                !$entity ||
                !password_verify($data->password, $entity->password) ||
                $entity->active == 0
            ) {
                return response()->json([
                            "message" => "Invalid User",
                            "status" => "error",
                            "data" => $entity
                            ], 401);
            }

            $userData = [
                'expiration_sec' => EXPIRATE_TOKEN,
                'host' => HOST_DEV,
                'userdata' => [
                    "id" => $entity->users_id,
                    "name" => $entity->name
                ]
            ];

            return response()->json([
                    "message" => "User Authorized",
                    "status" => "success",
                    "data" => [
                        "userId" => $entity->users_id,
                        "userName" => $entity->name,
                        "token" => Authenticator::generateToken($userData)
                    ]
                    ], 200);
        } catch (\Exception $ex) {
            return response()->json([
                    "message" => $ex->getMessage(),
                    "status" => "error",
                    "data" => ""
                    ], 500);
        }
    }

    public function loginInterno($data)
    {
        // Recebe o valor enviado pelo formulário de login
        $username = $data->get("usuario");
        $password = $data->get("senha");

        if ($username && $password) {
            $result = $this->join("users", "users.id", '=', "authentication.users_id")
                        ->where('username', md5($username))
                        ->first();

            if (!$result) {
                msg::showMsg('<strong>Usuário inválido.</strong>'
                    . ' Verifique se digitou corretamente.'
                    . '<script>focusOn("usuario");</script>', 'warning');
            }

            if ($result->active === 0) {
                msg::showMsg('<strong>Usuário Desabilitado!</strong><br>'
                    . ' Consulte o Admistrador do Sistema para mais informações.', 'danger');
            }

            if (password_verify($password, $result->password)) {
                self::registerSession($result, $data);
                return;
            } else {
                msg::showMsg('<strong>Ops! Algo está errado...</strong>'
                    . ' Verifique se digitou corretamente seu login e senha.'
                    . '<script>focusOn("password");</script>', 'warning');
            }
        }
        msg::showMsg('Todos os campos são de preenchimento obrigatório.', 'danger');
    }

    private static function registerSession($dados, Request $request)
    {
        $session = new Session();

        $session->startSession();

        $request->session()->put("tokenApp", $session->getToken());
        $request->session()->put("userId", $dados->users_id);

        echo '<meta http-equiv="refresh" content="0;URL=' . HOST_DEV . '/admin/dashboard">'
        . '<script type="text/javascript"> window.location.href="' . HOST_DEV . '/admin/dashboard"; </script>';
        return true; // stop script
    }

    public function verifyAccess(Request $request)
    {
        $data = (object) $request->all() ?: [];

        $user = DB::table('users_has_permission AS A')
            ->join('permission AS B', 'B.id', '=', 'A.permission_id')
            ->join('users AS C', 'C.id', '=', 'A.users_id')
            ->join('application AS D', 'D.id', '=', 'B.application_id')
            ->select('C.*', 'D.name AS application')
            ->where('B.uri', $request->uri)
            ->where('A.users_id', $request->userId)
            ->get();

        if (count($user) > 0) {
            return response()->json([
                "message" => "User Authorized",
                "status" => "success",
                "data" => $user
                ], 200);
        } else {
            return response()->json([
                "message" => "Access denied",
                "status" => "error",
                "data" => []
                ], 401);
        }
    }
}
