<?php

namespace Admin\Model;

use Core\Model\BaseModel;
use Doctrine\ORM\EntityManager;

class SegCategoriasRecursosModel extends BaseModel
{
    public function __construct(EntityManager $em, $entity)
    {
        parent::__construct($em, $entity);
    }
}