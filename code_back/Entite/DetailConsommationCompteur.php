<?php

namespace App\Entite;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class DetailConsommationCompteur
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    #[Column(type: 'string', length: 100)]
    private $nom;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $montant;

    /**
     * @var ConsommationCompteur
     */
    #[ManyToOne(targetEntity: 'App\Entite\ConsommationCompteur')]
    private $consommationCompteur;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
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

    /**
     * @return ConsommationCompteur
     */
    public function getConsommationCompteur(): ConsommationCompteur
    {
        return $this->consommationCompteur;
    }

    /**
     * @param ConsommationCompteur $consommationCompteur
     */
    public function setConsommationCompteur(ConsommationCompteur $consommationCompteur): void
    {
        $this->consommationCompteur = $consommationCompteur;
    }

    public static function init($detailJson)
    {
        $conso = new self();

        $conso->setNom($detailJson->nom);
        $conso->setMontant($detailJson->montant);

        return $conso;
    }
}