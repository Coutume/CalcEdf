<?php

namespace App\Controleur;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class CompteurController extends CommonController
{
    public function lister(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $factureRepository = $this->entityManager->getRepository('App\Entite\Compteur');
        $factures = $factureRepository->findAll();

        $response->getBody()->write($this->serializer->serialize($factures, 'json', ['groups' => 'facture']));
        return $response->withHeader('Content-Type', 'application/json');
    }
}