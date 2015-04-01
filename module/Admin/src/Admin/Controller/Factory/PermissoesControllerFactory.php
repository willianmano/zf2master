<?php

namespace Admin\Controller\Factory;

use Admin\Controller\PermissoesController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class PermissoesControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator()->get('ServiceManager');

        $controller = new PermissoesController();
        $controller->setModel($services->get('Admin\Model\SegPermissoesModel'));
        $controller->setModulosModel($services->get('Admin\Model\SegModulosModel'));
        $controller->setRecursosModel($services->get('Admin\Model\SegRecursosModel'));
        $controller->setForm($services->get('Admin\Form\PermissaoForm'));
        $controller->setFormFilter($services->get('Admin\Form\Filter\PermissaoFormFilter'));

        return $controller;
    }
}