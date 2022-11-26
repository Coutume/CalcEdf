<?php

use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Create Container using PHP-DI
$container = new Container();

$app = AppFactory::createFromContainer($container);
$app->setBasePath('/public');

$app->get('/', ['\App\Controleur\MainController', 'home']);

$app->get('/test', ['\App\Controleur\MainController', 'test']);

$app->run();
