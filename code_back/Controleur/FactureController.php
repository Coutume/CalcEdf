<?php

namespace App\Controleur;

use App\Entite\ConsommationCompteur;
use App\Entite\ConsommationPersonne;
use App\Entite\Facture;
use App\Repository\FactureRepository;
use DI\Annotation\Inject;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class FactureController extends CommonController
{
    public function lister(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $factureRepository = $this->entityManager->getRepository('App\Entite\Facture');
        $factures = $factureRepository->findBy([], ['dateFacture' => 'asc']);

        $response->getBody()->write($this->serializer->serialize($factures, 'json', ['groups' => 'facture']));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function recuperer(ServerRequestInterface $request, ResponseInterface $response, $id): ResponseInterface
    {
        $factureRepository = $this->entityManager->getRepository('App\Entite\Facture');
        $facture = $factureRepository->find($id);

        if(empty($facture))
        {
            return self::erreurReponse("la facture $id est introuvable.", $response);
        }

        $response->getBody()->write($this->serializer->serialize($facture, 'json', ['groups' => 'facture']));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function ajouter(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $donneesFacture = json_decode($request->getBody()->getContents());

        if(empty($donneesFacture))
        {
            throw new \Exception("Les données sur la facture sont manquantes.");
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

    public function modifier(ServerRequestInterface $request, ResponseInterface $response, $id): ResponseInterface
    {
        /**
         * @var $factureRepository FactureRepository
         */
        $factureRepository = $this->entityManager->getRepository('App\Entite\Facture');
        $facture = $factureRepository->find($id);
        $donneesFacture = json_decode($request->getBody()->getContents());

        $factureJson = $this->initFacture($donneesFacture);
        $erreurs = $this->validator->validate($factureJson);

        if(count($erreurs) > 0)
        {
            return $this->erreurValidationReponse($erreurs, $response);
        }

        $factureRepository->fusionner($facture, $factureJson);
        $this->entityManager->flush();

        return $response;
    }

    public function supprimer(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write("API de gestion des factures : supprimer. Non implémenté.");
        return $response;
    }

    protected function initFacture($factureJson)
    {
        $facture = new Facture();

        $date = \DateTime::createFromFormat('Y-m-d', $factureJson->saisies->dateFacture);

        $facture->setDateFacture(($date !== false ? $date->setTime(0, 0) : null));
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