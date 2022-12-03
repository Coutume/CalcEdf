<?php

namespace App\Repository;

use App\Entite\Facture;
use Doctrine\ORM\EntityRepository;

class FactureRepository extends EntityRepository
{
    public function fusionner(Facture $facture, Facture $nouvFacture)
    {
        $facture->getConsommationsCompteur()->clear();
        $facture->setConsommationsCompteur($nouvFacture->getConsommationsCompteur());
        $facture->getConsommationsPersonne()->clear();
        $facture->setConsommationsPersonne($nouvFacture->getConsommationsPersonne());
        $facture->setConsoKwHp($nouvFacture->getConsoKwHp());
        $facture->setConsoKwHc($nouvFacture->getConsoKwHc());
        $facture->setPrixKwHp($nouvFacture->getPrixKwHp());
        $facture->setPrixKwHc($nouvFacture->getPrixKwHc());
        $facture->setChargesTva5EurosAboHp($nouvFacture->getChargesTva5EurosAboHp());
        $facture->setChargesTva5EurosContribAchemElec($nouvFacture->getChargesTva5EurosContribAchemElec());
        $facture->setChargesTva20TaxeConsoFinale($nouvFacture->getChargesTva20TaxeConsoFinale());
        $facture->setChargesTva20ContribServPub($nouvFacture->getChargesTva20ContribServPub());
        $facture->setTotal($nouvFacture->getTotal());
    }
}