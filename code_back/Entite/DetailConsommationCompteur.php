<?php

namespace App\Entite;

use App\Config\ValidationMessage;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Type;

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
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[Length(min: 1, max: 100, minMessage: ValidationMessage::STRING_TAILLE_MIN, maxMessage: ValidationMessage::STRING_TAILLE_MAX)]
    private $nom;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
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
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom): void
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
    public function setMontant($montant): void
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