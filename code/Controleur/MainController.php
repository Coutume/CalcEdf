<?php

namespace App\Controleur;

use App\Database\Connexion;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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
}