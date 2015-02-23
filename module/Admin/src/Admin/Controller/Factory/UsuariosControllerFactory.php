<?php

namespace Admin\Controller\Factory;

use Admin\Controller\UsuariosController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UsuariosControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator()->get('ServiceManager');

        $controller = new UsuariosController();
        $controller->setModel($services->get('Admin\Model\SegUsuariosModel'));
        $controller->setForm($services->get('Admin\Form\UsuarioForm'));
        $controller->setFormFilter($services->get('Admin\Form\Filter\UsuarioFormFilter'));

        return $controller;
    }
}