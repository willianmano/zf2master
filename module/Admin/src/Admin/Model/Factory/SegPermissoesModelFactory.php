<?php

namespace Admin\Model\Factory;

use Admin\Model\SegPermissoesModel;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SegPermissoesModelFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $entityManager = $services->get('Doctrine\ORM\EntityManager');

        return new SegPermissoesModel($entityManager, 'Admin\Entity\SegPermissoes');
    }
}