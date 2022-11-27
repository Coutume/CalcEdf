<?php

namespace App\Controleur;

use App\Entite\Facture;
use DI\Annotation\Inject;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FactureController
{
    /**
     * @Inject(name="entityManager")
     * @var EntityManager
     */
    private $entityManager;

    public function lister(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $response->getBody()->write("API de gestion des factures : lister. Non implémenté.");
        return $response;
    }

    public function ajouter(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $donneesFacture = json_decode($request->getBody()->getContents());
        $facture = Facture::init($donneesFacture);
        $this->entityManager->persist($facture);
        $this->entityManager->flush();
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', '*');
    }

    public function modifier(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $response->getBody()->write("API de gestion des factures : modifier. Non implémenté.");
        return $response;
    }

    public function supprimer(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $response->getBody()->write("API de gestion des factures : supprimer. Non implémenté.");
        return $response;
    }
}