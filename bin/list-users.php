<?php

use DevFullStack\Entity\Order;
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

$usersRepository = $entityManager->getRepository(User::class);

/** @var User[] $usersList */
$usersList = $usersRepository->findAll();

foreach ($usersList as $user) {
    echo "ID: $user->id\nNome: $user->first_name\nSobrenome: $user->last_name\nOrder: ";
    echo implode(', ', $user->order()
        ->map(fn (Order $order) => "{$order->description} ($order->quantity)")
        ->toArray());

//    if ($user->phones()->count() > 0) {
//        echo PHP_EOL;
//        echo "Telefones: ";
//
//        echo implode(', ', $user->phones()
//            ->map(fn(Phone $phone) => $phone->number)
//            ->toArray());
//    }
//
//    if ($user->courses()->count() > 0) {
//        echo PHP_EOL;
//        echo "Cursos: ";
//
//        echo implode(', ', $user->courses()
//            ->map(fn(Course $course) => $course->nome)
//            ->toArray());
//    }

    echo PHP_EOL . PHP_EOL;
}

echo $usersRepository->count([]) . PHP_EOL;