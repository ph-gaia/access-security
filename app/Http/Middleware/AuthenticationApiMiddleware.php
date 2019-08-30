<?php
namespace App\Http\Middleware;

use App\Helpers\Authenticator;
use Illuminate\Http\Request;
use Closure;

class AuthenticationApiMiddleware
{

    /**
     * Verify the authenticate os user
     *
     * @author Paulo Henrique <paulo.gaia@seduc.pa.gov.br>
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        try {
            if (Authenticator::isValidLogin($request)) {
                return $next($request);
            }
        } catch (\Exception $ex) {
            return response()->json([
                    "message" => $ex->getMessage(),
                    "status" => "error"
                    ], 401);
        }
    }
}
