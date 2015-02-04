<?php

namespace Admin\Model\Factory;

use Admin\Model\SegCategoriasRecursosModel;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SegCategoriasRecursosModelFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $entityManager = $services->get('Doctrine\ORM\EntityManager');

        return new SegCategoriasRecursosModel($entityManager, 'Admin\Entity\SegCategoriasRecursos');
    }
}