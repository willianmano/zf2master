<?php
namespace Admin\Service;

use Zend\Crypt\Password\Bcrypt;

class AuthService
{
    protected $sessionManager;
    protected $dbalConn;

    public function authenticate($params)
    {
        if (!isset($params['usrUsuario']) || $params['usrUsuario'] == '' || !isset($params['usrSenha']) ||  $params['usrSenha'] == '') {
            return false;
        }

        $sql = "SELECT usr_id, usr_nome, usr_email, usr_senha FROM seg_usuarios WHERE usr_usuario = ?";
        $user = $this->dbalConn->executeQuery($sql, array($params['usrUsuario']))->fetch();

        if ($user) {
            $bcrypt = new Bcrypt();
            $verify = $bcrypt->verify($params['usrSenha'], $user['usr_senha']);

            if ($verify) {
                unset($user['usr_senha']);
                $this->sessionManager->offsetSet('zf2master_loggeduser', $user);

                return true;
            }
        }

        return false;
    }
    public function isLogged()
    {
        $user = $this->sessionManager->offsetGet('zf2master_loggeduser');
        if ( isset($user) ) {
            return true;
        }

        return false;
    }
    public function logout()
    {
        //$auth = new AuthenticationService();
        $this->sessionManager->offsetUnset('zf2master_loggeduser');
        //$auth->clearIdentity();
        return true;
    }

    /**
     * @param mixed $sessionManager
     */
    public function setSessionManager($sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    /**
     * @param mixed $dbalConn
     */
    public function setDbalConn($dbalConn)
    {
        $this->dbalConn = $dbalConn;
    }

}
