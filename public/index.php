<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/api');

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("shigoto wo hajimemashou !");
    return $response;
});

$app->get('/test', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Premier webservice");
    return $response;
});

$app->run();
