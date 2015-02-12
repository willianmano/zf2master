<?php
namespace Admin;

use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        $moduleManager = $e->getApplication()->getServiceManager()->get('modulemanager');
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        $sharedEvents->attach(
            'Zend\Mvc\Controller\AbstractActionController',
            MvcEvent::EVENT_DISPATCH,
            array($this, 'controllerPreDispatch'),
            100
        );
    }

    public function controllerPreDispatch($e)
    {
        $serviceLocator = $e->getTarget()->getServiceLocator();
        $routeMatch = $e->getRouteMatch();
        $moduleName = $routeMatch->getParam('module') ?: "application";

        $controllerName = $routeMatch->getParam('controller');
        $controllerName = explode("\\", $controllerName);
        $controllerName = strtolower($controllerName[2]);

        $actionName = strtolower($routeMatch->getParam('action'));

        $authService = $serviceLocator->get('Admin\Service\AuthorizationService');
        if (! $authService->grantAccess($moduleName, $controllerName, $actionName)) {

            // para a execucao do codigo dentro da action
            $e->stopPropagation(true);

            $redirect = $e->getTarget()->redirect();

            $auth = $serviceLocator->get('Admin\Service\AuthService');
            if ( $auth->isLogged() ) {
                $redirect->toUrl('/');
            } else {
                $redirect->toUrl('/admin/auth');
            }
        }

        return true;
    }
}
