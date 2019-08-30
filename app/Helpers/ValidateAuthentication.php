<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Helpers\Authenticator;
use App\Exceptions\HeaderWithoutAuthorizationException;

class ValidateAuthentication
{

    /**
     * Returns the data of token passed on Request
     * @since 1.0
     * @param Request $request
     * @return \stdClass
     * @throws HeaderWithoutAuthorizationException
     */
    public static function token(Request $request)
    {
        $authorization = $request->header('Authorization');

        if (!isset($authorization)) {
            throw new HeaderWithoutAuthorizationException('The request does not contain the Authorization header');
        }

        $token = preg_replace('/^\w+\s/', '', $authorization);

        return Authenticator::decodeToken($token);
    }
}
