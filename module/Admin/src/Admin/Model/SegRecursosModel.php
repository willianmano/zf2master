<?php

namespace Admin\Model;

use Core\Model\BaseModel;
use Doctrine\ORM\EntityManager;

class SegRecursosModel extends BaseModel
{
    public function __construct(EntityManager $em, $entity)
    {
        parent::__construct($em, $entity);
    }
}