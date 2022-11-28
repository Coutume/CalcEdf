<?php

namespace App\Controleur;

use App\Database\Connexion;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\App;
use Throwable;

class MainController
{
    private $connHelper;

    public function __construct(Connexion $connexion)
    {
        $this->connHelper = $connexion;
    }

    public function home(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $response->getBody()->write("API de gestion des factures.");
        return $response;
    }

    public function test(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $this->connHelper->getConnexion();
        return $response;
    }

    public function listerEnTetes(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $response;
    }

    /**
     * Initialise la récupération de toutes les erreurs par Slim via middleware
     * @param App $app
     * @return void
     */
    public static function initErrorRoutingMiddleware(App $app)
    {
        $app->addRoutingMiddleware();

        $customErrorHandler = function (
            ServerRequestInterface $request,
            Throwable $exception,
            bool $displayErrorDetails,
            bool $logErrors,
            bool $logErrorDetails,
            ?LoggerInterface $logger = null
        ) use ($app) {
            $logger->error($exception->getMessage());

            $payload = ['error' => true, 'message' => $exception->getMessage()];

            $response = $app->getResponseFactory()->createResponse();
            $response->getBody()->write(
                json_encode($payload, JSON_UNESCAPED_UNICODE)
            );

            return $response->withStatus(500);
        };

        $errorMiddleware = $app->addErrorMiddleware(true, true, true);
        $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
    }
}