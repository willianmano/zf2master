<?php

namespace Core\Model;

use Doctrine\ORM\EntityManager;

abstract class BaseModel
{
    protected $entityManager, $repository, $entity;

    public $entityPrimaryKey;

    public function __construct(EntityManager $em, $entity)
    {
        $this->entityManager = $em;

        if( !class_exists($entity)) {
            throw new \Exception("The Class '{$entity}' was not found!");
        }

        $this->entity = $entity;

        $this->repository = $this->entityManager->getRepository($entity);

        $this->entityPrimaryKey = $entity::getIdentifier();
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function find($id)
    {
        return $this->repository->find((int)$id);
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

    public function update($data)
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

    /*
   * Carrega os itens passando um campo e o valor
   * Ex. array($attributes => $value)
   */
    public function getByAttributes(Array $array)
    {
        return $this->repository->findBy($array);
    }

    //Popula Select
    public function getAllItensToSelect($attributeId,$attributeLabel)
    {
        $data = $this->findAll();

        $returnObject[] = '';
        foreach ($data as $key => $value) {
            $returnObject[$value->$attributeId] = $value->$attributeLabel;
        }

        return $returnObject;
    }
    public function getAllItensToSelectByAttributesJsonReturn(Array $attributes, $attributeId, $attributeLabel) {
        $data = $this->getByAttributes($attributes);

        $returnObject[] = '';
        foreach ($data as $key => $value) {
            $returnObject[] = array($attributeId => $value->$attributeId,  $attributeLabel => $value->$attributeLabel);
        }
        return $returnObject;
    }
}