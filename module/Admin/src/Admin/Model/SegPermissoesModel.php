<?php

namespace Admin\Model;

use Core\Model\BaseModel;
use Doctrine\ORM\EntityManager;

class SegPermissoesModel extends BaseModel
{
    public function __construct(EntityManager $em, $entity)
    {
        parent::__construct($em, $entity);
    }

    public function save($data) {
        try {
            $permissao = new $this->entity;
            $permissao->exchangeArray($data);
            $permissao->prmRcs = $data['prmRcs'];

            $this->entityManager->transactional(function ($em) use ($permissao) {
                $em->persist($permissao);
            });
        } catch (\Exception $e) {
            $env = getenv('APPLICATION_ENV') ?: 'production';

            if ($env == 'development') {
                throw $e;
            }

            throw new \Exception("An error occurred while save the object. Please, report it to the technical support");
        }

        return $permissao;
    }
}