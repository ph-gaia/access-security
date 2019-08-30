<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use App\Exceptions\InvalidUserException;
use App\Exceptions\ExpiredUserException;
use Illuminate\Http\Request;

class Authenticator
{

    /**
     * Generate the JSON Web Token
     *
     * @since 1.0
     * @param array $options
     * @return string
     */
    public static function generateToken(array $options)
    {
        $issuedAt = time();
        $expire = $issuedAt + $options['expiration_sec']; // tempo de expiracao do token

        $tokenParam = [
            'iat' => $issuedAt, // timestamp de geracao do token
            'iss' => $options['host'], // dominio, pode ser usado para descartar tokens de outros dominios
            'exp' => $expire, // timestamp de quando o token irá expirar
            'nbf' => $issuedAt - 1, // token nao eh valido Antes de
            'data' => $options['userdata'], // Dados do usuario logado
        ];

        return JWT::encode($tokenParam, SALT_KEY);
    }

    /**
     * Decode the JWT used by user
     *
     * @since 1.0
     * @param string $token
     * @return \stdClass
     */
    public static function decodeToken($token)
    {
        return JWT::decode($token, SALT_KEY, ['HS256']);
    }

    /**
     * Check the validate of authenticate User
     * @param Request $request
     * @return boolean
     * @throws InvalidUserException
     * @throws ExpiredUserException
     * @throws HeaderWithoutAuthorizationException
     */
    public static function isValidLogin(Request $request)
    {
        $token = ValidateAuthentication::token($request);
        $currentHost = $request->getHttpHost();
        if (isset($token->iss) && $token->iss !== $currentHost) {
            throw new InvalidUserException("Host with access denied");
        }
        if (isset($token->exp) && $token->exp < time()) {
            throw new ExpiredUserException("User with expired authentication");
        }
        return true;
    }
}
