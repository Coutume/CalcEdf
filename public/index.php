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

$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write("shigoto wo hajimemashou !");
    return $response;
});

$app->get('/test', function (Request $request, Response $response, $args)
{
    $connexion = $this->get('\App\Database\Connexion');
    $conn = $connexion->getConnexion();
    $response->getBody()->write("Premier webservice");


    return $response;
});

$app->run();
