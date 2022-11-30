<?php

namespace App\Controleur;

use App\Entite\ConsommationCompteur;
use App\Entite\ConsommationPersonne;
use App\Entite\Facture;
use DI\Annotation\Inject;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FactureController extends CommonController
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

        if(empty($donneesFacture))
        {
            throw new \Exception("Les données sur la facture sont manquants.");
        }

        $facture = $this->initFacture($donneesFacture);
        $erreurs = $this->validator->validate($facture);

        if(count($erreurs) > 0)
        {
            return $this->erreurValidationReponse($erreurs, $response);
        }

        $this->entityManager->persist($facture);
        $this->entityManager->flush();
        return $response;
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

    protected function initFacture($factureJson)
    {
        $facture = new Facture();

        $date = \DateTime::createFromFormat('Y-m-d', $factureJson->saisies->dateFacture);

        $facture->setDate(($date !== false ? $date->setTime(0, 0) : null));
        $facture->setConsoKwHp($factureJson->saisies->consoKwHp);
        $facture->setConsoKwHc($factureJson->saisies->consoKwHc);
        $facture->setPrixKwHp($factureJson->saisies->prixKwHp);
        $facture->setPrixKwHc($factureJson->saisies->prixKwHc);
        $facture->setChargesTva5EurosAboHp($factureJson->saisies->chargesTva5EurosAboHp);
        $facture->setChargesTva5EurosContribAchemElec($factureJson->saisies->chargesTva5EurosContribAchemElec);
        $facture->setChargesTva20TaxeConsoFinale($factureJson->saisies->chargesTva20TaxeConsoFinale);
        $facture->setChargesTva20ContribServPub($factureJson->saisies->chargesTva20ContribServPub);
        $facture->setTotal(str_replace(',', '.', $factureJson->saisies->total));

        foreach ($factureJson->compteurs as $compteurJson)
        {
            $compteurRef = $this->entityManager->getReference('App\Entite\Compteur', $compteurJson->compteur->id);
            $facture->addConsommationsCompteur(ConsommationCompteur::init($compteurJson, $compteurRef));
        }

        foreach ($factureJson->personnes as $personneJson)
        {
            $personneRef = $this->entityManager->getReference('App\Entite\Personne', $personneJson->personne->id);
            $facture->addConsommationsPersonne(ConsommationPersonne::init($personneJson, $personneRef));
        }

        return $facture;
    }
}