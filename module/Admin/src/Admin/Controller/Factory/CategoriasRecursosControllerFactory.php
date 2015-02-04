<?php

namespace Admin\Controller\Factory;

use Core\Controller\CrudController;
use Admin\Controller\CategoriasRecursosController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoriasRecursosControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator()->get('ServiceManager');

        $controller = new CategoriasRecursosController();
        $controller->setModel($services->get('Admin\Model\SegCategoriasRecursosModel'));

        return $controller;
    }
}