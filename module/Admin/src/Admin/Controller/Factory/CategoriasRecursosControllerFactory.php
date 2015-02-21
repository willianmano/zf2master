<?php

namespace Admin\Controller\Factory;

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
        $controller->setForm($services->get('Admin\Form\CategoriaRecursoForm'));
        $controller->setFormFilter($services->get('Admin\Form\Filter\CategoriaRecursoFormFilter'));

        return $controller;
    }
}