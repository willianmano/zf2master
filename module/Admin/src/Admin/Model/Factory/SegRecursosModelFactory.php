<?php

namespace Admin\Model\Factory;

use Admin\Model\SegRecursosModel;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SegRecursosModelFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $entityManager = $services->get('Doctrine\ORM\EntityManager');

        return new SegRecursosModel($entityManager, 'Admin\Entity\SegRecursos');
    }
}