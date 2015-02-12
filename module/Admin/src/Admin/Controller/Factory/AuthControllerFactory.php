<?php

namespace Admin\Controller\Factory;

use Admin\Controller\AuthController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator()->get('ServiceManager');

        $controller = new AuthController();
        $controller->setForm($services->get('Admin\Form\LoginForm'));
        $controller->setServiceManager($services);

        return $controller;
    }
}