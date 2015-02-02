<?php

namespace Admin\Controller\Factory;

use Admin\Controller\ModulosController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModulosControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator()->get('ServiceManager');

        $controller = new ModulosController();
        $controller->setModulos($services->get('Admin\Model\SegModulosModel'));

        return $controller;
    }
}