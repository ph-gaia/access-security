<?php
/**
 * @author Paulo Henrique Gaia <paulo.gaia@seduc.pa.gov.br>
 * 
 * @file Access.php
 * @version 1.0
 * - Helper que auxilia no gerencimento de controle de acesso a páginas
 */
namespace App\Helpers;
 
use Illuminate\Http\Request;
use App\Helpers\Session;
use App\Models\Auth;

class Access
{

    protected $entidade = "users";
    private $url;
    private $nivelAcesso = [];
    private $breakRedirect = false;

    /**
     * Método usado para para setar os possíveis niveis de acesso
     */
    private function setNivelAcesso(array $nivelAcesso)
    {
        // seta para o array os possíveis níveis de acesso
        $this->nivelAcesso = array_merge($this->nivelAcesso, $nivelAcesso);
    }

    /**
     * Método usado para comparar o nível de acesso do usuário com os
     * padrões de níveis de acesso
     */
    private function verificarNivelAcesso($nivelAcessoIndicado)
    {
        // procura no Array o nível de acesso indicado nos padrões de nivel de acesso
        return in_array($nivelAcessoIndicado, $this->nivelAcesso);
    }

    /**
     * Método usado para permitir o acesso somente ao usuário logado
     */
    public function authenticAccess(array $nivelAcesso)
    {
        $session = new Session();
        $session->startSession();
        $request = Request();

        // Compara o registro de token da sessão com o
        // token gerado automaticamente

        if (!$request->session()->has('tokenApp')) {
            $session->stopSession();
            $this->redirectTo(URI_LOGIN);
        }
        if ($request->session()->get('tokenApp') == $session->getToken()) {
            $result = Auth::select("authentication.level","users.*")
                        ->join("users", "users.id", '=', "authentication.users_id")
                        ->where('users.id', $request->session()->get('userId'))
                        ->first();

            // Seta os níveis de acesso permitidos na página
            $this->setNivelAcesso($nivelAcesso);
            // Verifica se o usuário tem permissão de acesso
            if (!$this->verificarNivelAcesso($result->level)) {
                // Redireciona o usuário sem permissão
                // de acesso para página inicial
                $this->redirectTo();
                return;
            }
            // Retorna o resultado da consulta
            // feita no Banco de Dados com o ID fornecido
            return $result;
        }
        $session->stopSession();
        $this->redirectTo();
    }

    /**
     * Método usado para evitar o RELOGIN do usuário
     */
    public function notAuthenticatedAccess()
    {
        $session = new Session();
        $session->startSession();
        // Compara o registro de token da sessão com o token gerado automaticamente
        if (isset($_SESSION['tokenApp']) && $_SESSION['tokenApp'] == $session->getToken()) {
            // Redireciona para página incial
            $this->redirectTo(); // url = /
        }
        $session->stopSession();
        return true;
    }

    private function redirectTo($url = null)
    {
        $url = $this->url ? : $url;

        // Redireciona se o atributo breakRedirect conter o valor false
        if (!$this->breakRedirect) {
            echo '<meta http-equiv="refresh" content="0;URL=' . HOST_DEV . $url . '" />'
            . '<script>window.location = "' . HOST_DEV . $url . '"; </script>';
            header('Location:' . HOST_DEV . $url);
            exit;
        }
    }

    public function setRedirect($url = null)
    {
        $this->url = $url ? : false;
        return $this;
    }

    public function breakRedirect()
    {
        $this->breakRedirect = true;
        return $this;
    }

    public function clearAccessList()
    {
        $this->nivelAcesso = [];
        return $this;
    }
}
