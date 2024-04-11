<?php

use DevFullStack\Entity\User;
use DevFullStack\Helper\ConfigHelper;
use DevFullStack\Helper\EntityManagerCreator;

// replace with path to your own project bootstrap file
require_once __DIR__ . '/../vendor/autoload.php';

// Require configuration file
require_once __DIR__ . '/../config/config.php';

ConfigHelper::setTimeZone();

// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManagerCreator::createEntityManager();

/** @var User $user */
$user = $entityManager->find(User::class, $argv[1]);
//var_dump($user);
//exit();

$entityManager->remove($user);
$entityManager->flush();