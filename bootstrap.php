<?php

use DI\Container;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once "vendor/autoload.php";

$container = new Container();

$conn = $container->get('App\Database\Connexion');

$entityManager = $conn->initEntityManager();