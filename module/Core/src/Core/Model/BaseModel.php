<?php

namespace Core\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Core\Entity\BaseEntity;

abstract class BaseModel
{
    protected $entityManager, $entity, $repository;

    public function __construct(EntityManager $em, $entity)
    {
        $this->entityManager = $em;

        if( !class_exists($entity)) {
            throw new \Exception("The Class '{$entity}' was not found!");
        }

        $this->entity = $entity;

        $this->repository = $this->entityManager->getRepository($entity);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function save($data)
    {
        try {
            $entity = $data;

            if (!$data instanceof $this->entity && is_object($data)) {
                throw new \Exception("You only can pass an Array or an instance of {$this->entity}");
            }

            if (!$data instanceof $this->entity) {
                $entity = new $this->entity;
                $entity->exchangeArray($data);
            }

            $this->entityManager->transactional(function ($em) use ($entity) {
                $em->persist($entity);
            });
        } catch (\Exception $e) {
            $env = getenv('APPLICATION_ENV') ?: 'production';

            if ($env == 'development') {
                throw $e;
            }

            throw new \Exception("An error occurred while save the object. Please, report it to the technical support");
        }

        return $entity;
    }

    public function delete($entity)
    {
        try{

            if (!$entity instanceof $this->entity && !is_int($entity)) {
                throw new \Exception("You only can pass an Integer or an instance of {$this->entity}!");
            }

            if (!$entity instanceof $this->entity) {
                $entity = $this->find($entity);
            }

            $this->entityManager->transactional(function ($em) use ($entity) {
                $em->remove($entity);
            });
        } catch(\Exception $e) {
            $env = getenv('APPLICATION_ENV') ?: 'production';

            if ($env == 'development') {
                throw $e;
            }

            throw new \Exception("An error occurred while save the object. Please, report it to the technical support");
        }

        return true;
    }
}