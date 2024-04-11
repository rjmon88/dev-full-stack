<?php

use DevFullStack\Helper\ConfigHelper;
use DevFullStack\Helper\EntityManagerCreator;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// replace with path to your own project bootstrap file
require_once __DIR__ . '/../vendor/autoload.php';

// Require configuration file
require_once __DIR__ . '/../config/config.php';

ConfigHelper::setTimeZone();

// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManagerCreator::createEntityManager();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);