<?php

namespace DevFullStack\Mapper;

use DevFullStack\Helper\EntityManagerCreator;
use Doctrine\ORM\EntityManager;

class MapperObject
{
    protected static EntityManager $entityManager;

    public function __construct()
    {
        self::$entityManager = EntityManagerCreator::createEntityManager();
    }
}
