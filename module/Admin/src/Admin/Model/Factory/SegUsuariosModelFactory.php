<?php

namespace Admin\Model\Factory;

use Admin\Model\SegUsuariosModel;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SegUsuariosModelFactory  implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $entityManager = $services->get('Doctrine\ORM\EntityManager');

        return new SegUsuariosModel($entityManager, 'Admin\Entity\SegUsuarios');
    }
}