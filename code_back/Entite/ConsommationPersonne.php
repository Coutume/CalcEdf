<?php

namespace App\Entite;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class ConsommationPersonne
{
    /**
     * @var integer
     */
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private $id;

    /**
     * @var Personne
     */
    #[ManyToOne(targetEntity: 'App\Entite\Personne')]
    private $personne;

    /**
     * @var Facture
     */
    #[ManyToOne(targetEntity: 'App\Entite\Facture', inversedBy: 'consommationsPersonne')]
    private $facture;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $total;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Personne
     */
    public function getPersonne(): Personne
    {
        return $this->personne;
    }

    /**
     * @param Personne $personne
     */
    public function setPersonne(Personne $personne): void
    {
        $this->personne = $personne;
    }

    /**
     * @return Facture
     */
    public function getFacture(): Facture
    {
        return $this->facture;
    }

    /**
     * @param Facture $facture
     */
    public function setFacture(Facture $facture): void
    {
        $this->facture = $facture;
    }

    /**
     * @return float
     */
    public function getMontant(): float
    {
        return $this->montant;
    }

    /**
     * @param float $montant
     */
    public function setMontant(float $montant): void
    {
        $this->montant = $montant;
    }
}