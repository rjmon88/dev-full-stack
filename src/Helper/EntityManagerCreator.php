<?php

namespace DevFullStack\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class EntityManagerCreator
{
    public static function createEntityManager(): EntityManager
    {
        // Create a simple "default" Doctrine ORM configuration for Attributes
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . '/..'],
            isDevMode: ConfigHelper::isDevMode(),
        );

        // configuring the database connection
        $connection = DriverManager::getConnection(
            params: ConfigHelper::getConnectionParams(),
            config: $config
        );

        // obtaining the entity manager
        return new EntityManager($connection, $config);
    }
}
