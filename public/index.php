<?php

use App\Config\ContainerConfig;
use App\Controleur\MainController;
use DI\Bridge\Slim\Bridge;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// initialisation du conteneur de dépendances
$container = ContainerConfig::initContainer();

// initialisation de l'application
$app = Bridge::create($container);
$app->setBasePath('/public');

MainController::initErrorRoutingMiddleware($app);

$app->add(function (Request $request, RequestHandler $handler) {
    $response = $handler->handle($request);
    return $response->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', '*');
});
$app->get('/', ['\App\Controleur\MainController', 'home']);
$app->get('/test', ['\App\Controleur\MainController', 'test']);

$app->get('/facture/recuperer/{id}', ['\App\Controleur\FactureController', 'recuperer']);
$app->options('/facture/recuperer/{id}', ['\App\Controleur\MainController', 'listerEnTetes']);

$app->post('/facture/ajouter', ['\App\Controleur\FactureController', 'ajouter']);
$app->options('/facture/ajouter', ['\App\Controleur\MainController', 'listerEnTetes']);

$app->post('/facture/modifier/{id}', ['\App\Controleur\FactureController', 'modifier']);
$app->options('/facture/modifier/{id}', ['\App\Controleur\MainController', 'listerEnTetes']);

$app->get('/facture/lister', ['\App\Controleur\FactureController', 'lister']);
$app->options('/facture/lister', ['\App\Controleur\MainController', 'listerEnTetes']);

$app->get('/compteur/lister', ['\App\Controleur\CompteurController', 'lister']);
$app->options('/compteur/lister', ['\App\Controleur\MainController', 'listerEnTetes']);

$app->run();
