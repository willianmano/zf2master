<?php

namespace Core\Model;


use Doctrine\ORM\EntityManager;

abstract class BaseModel {

    protected $entityManager, $entity, $repository;

    public function __construct(EntityManager $em, $entity)
    {
        $this->entityManager = $em;
        $this->entity = $entity;

        $this->repository = $this->entityManager->getRepository($this->entity);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function find($id)
    {
        return  $this->repository->find($id);
    }

}