<?php

use DevFullStack\Entity\Order;
use DevFullStack\Entity\User;
use DevFullStack\Helper\ConfigHelper;
use DevFullStack\Helper\EntityManagerCreator;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

// replace with path to your own project bootstrap file
require_once __DIR__ . '/../vendor/autoload.php';

// Require configuration file
require_once __DIR__ . '/../config/config.php';

ConfigHelper::setTimeZone();

// replace with mechanism to retrieve EntityManager in your app
$entityManager = EntityManagerCreator::createEntityManager();

$dateNow = new DateTime();
$user = new User(
    'João',
    'Silva',
    'doc',
    'a@a.a',
    '(99) 99999-9999',
    new DateTime('2024-04-01'),
    $dateNow,
    $dateNow,
);

$user->addOrder(new Order(
    'Arroz',
    1,
    5,
    $dateNow,
    $dateNow,
));
$user->addOrder(new Order(
    'Feijão',
    2,
    10,
    $dateNow,
    $dateNow,
));

try {
    $entityManager->persist($user);
} catch (ORMException $e) {
    exit($e->getMessage());
}
try {
    $entityManager->flush();
} catch (OptimisticLockException $e) {
    exit($e->getMessage());
} catch (ORMException $e) {
    exit($e->getMessage());
}