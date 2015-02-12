<?php
namespace Admin\Service;

class AuthorizationService
{
    protected $serviceManager;
    protected $sessionManager;
    protected $dbalConn;

    public function grantAccess($moduleName, $controllerName, $actionName, $displayMessage = true)
    {
        $flashmessenger = $this->serviceManager->get('ControllerPluginManager')->get('flashmessenger');

        $enabledPermissions = $this->serviceManager->get('Config');
        $enabledPermissions = $enabledPermissions['access_control'];

        $preLoginOpenActions = $enabledPermissions['preloginopenactions'];
        $postLoginOpenActions = $enabledPermissions['postloginopenactions'];

        if ($this->checkPrePostAccess($preLoginOpenActions, $moduleName, $controllerName, $actionName)) {
            return true;
        }

        $auth = $this->serviceManager->get('Admin\Service\AuthService');
        if ( $auth->isLogged() ) {
            if ($this->checkPrePostAccess($postLoginOpenActions, $moduleName, $controllerName, $actionName)) {
                return true;
            } elseif ($this->checkPermission($moduleName, $controllerName, $actionName)) {
                return true;
            }

            if($displayMessage) {
                // so exibe a mensagem de erro se o usuario estiver logado
                $flashmessenger->setNamespace('error')->addMessage('Acesso proibido!');
                return false;
            }
        }

        return false;
    }

    private function checkPermission($modulename, $controllerName, $actionName)
    {
        return true;
        $user = $this->sessionManager->offsetGet('zf2base_loggeduser');

        $sql = "SELECT prm_id, prm_nome FROM seg_permissoes p
                INNER JOIN seg_perfis_permissoes pp ON prp_prm_id = prm_id
                INNER JOIN seg_recursos r ON rcs_id = prm_rcs_id
                INNER JOIN seg_modulos m ON mod_id = rcs_mod_id
                WHERE mod_nome = ?
                  AND rcs_nome = ?
                  AND prm_nome = ?
                  AND prp_prf_id = (
                    SELECT prf_id FROM seg_perfis
                    INNER JOIN seg_modulos ON mod_id = prf_mod_id
                    INNER JOIN seg_perfis_usuarios ON pru_prf_id = prf_id
                    WHERE pru_usr_id = ? AND mod_nome = ? AND r.rcs_ativo = 1
                  )";
        $data = array($modulename, $controllerName, $actionName, $user['usr_id'], $modulename);
        $res = $this->dbalConn->executeQuery($sql, $data)->fetchAll();

        if (sizeof($res) || $controllerName == 'async') {
            return true;
        }

        return false;
    }
    /**
     * Verifica se a Action acessa tem o acesso liberado via configuracao
     * Utilizada para verificar Actions liberadas tanto antes do login quanto depois do login
     *
     * @param  array   $openActions
     * @param  string  $moduleName
     * @param  string  $controllerName
     * @param  string  $actionName
     * @return boolean
     */
    private function checkPrePostAccess($openActions, $moduleName, $controllerName, $actionName)
    {
        $openModules = array_keys($openActions);
        if (in_array($moduleName, $openModules)) {
            $openControllers = array_keys($openActions[$moduleName]);
            if (in_array($controllerName, $openControllers)) {
                if (in_array($actionName, $openActions[$moduleName][$controllerName])) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param mixed $serviceManager
     */
    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
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
