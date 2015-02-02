<?php

namespace Admin\Model\Factory;

use Admin\Model\SegModulosModel;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SegModulosModelFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $entityManager = $services->get('Doctrine\ORM\EntityManager');

        return new SegModulosModel($entityManager, 'Admin\Entity\SegModulos');
    }
}