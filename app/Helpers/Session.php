<?php

namespace App\Helpers;

class Session
{

    private $sessionId;
    private $token;
    private $ip;
    private $userAgent;
    private $cripto;

    public function __construct()
    {
        // configura os atributos
        $this->config();
    }
    /*
     * Método usado para configurar os atributos da Classe
     */

    private function config()
    {
        // recebe o valor IP do usuário
        $this->ip = $_SERVER['REMOTE_ADDR'];
        // recebe o User Agente do usuário
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        // Seta o valor do Token gerado
        $this->setToken();
    }

    /*
     * Método usado para gerar os caracteres usados como token
     */
    private function setToken()
    {
        // "salt+ip+ProgramaNome+ProgramaVersao+User Agent+salt"
        $strSalt = SALT_KEY . $this->ip . APPNAME . APPVERSION . $this->userAgent . SALT_KEY;
        // sha1 with md5 inside
        $this->token = sha1(SALT_KEY . md5($strSalt) . SALT_KEY);
    }

    /*
     * Método usado para gerar os caracteres usados como token
     */
    public function getToken()
    {
        return $this->token;
    }

    public function startSession($sessionId = null)
    {
        /// Verfica se foi passado um id de sessão existente
        if ($sessionId) {
            /// Recupera sessão exitente
            isset($this->sessionId) ? session_id($sessionId) : null;
        }

        /// verifica se a GLOBAL SESSION foi iniciada
        if (isset($_SESSION)) {
            /// Compara o token da sessão
            if ($_SESSION['tokenApp'] != $this->getToken()) {
                // se houver divergencia no token, destroy a sessão
                $this->stopSession();
                return false;
            }
            return true;
        } else {
            /// Caso a Sessão não seja iniciada, inicia o processo de criação da sessão
            session_set_cookie_params(
                1800, // Tempo de vida da sessão. Padrão 30min
                APPDIR, // Path da Sessão
                HOST_DEV, // Nome no Domínio
                false, // SSL
                true // HTTP Only
            );
            session_start();
            session_regenerate_id(true);
        }
        // gera um ID novo para a sessão
        // seta o ID da sessão para o atributo 'sessionId'
        $this->sessionId = session_id();
        return null;
    }
    /*
     * Método usado para destruir as sessões
     */

    public function stopSession()
    {
        // Verifica se a global foi iniciada, caso contrário inicia a sessão
        isset($_SESSION) ? null : session_start();
        // Destroi a sessão
        return session_destroy();
    }
}
