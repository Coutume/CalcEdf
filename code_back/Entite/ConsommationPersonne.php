<?php

namespace App\Entite;

use App\Config\ValidationMessage;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Type;

#[Entity]
class ConsommationPersonne
{
    /**
     * @var integer
     */
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    #[Groups(['facture'])]
    private $id;

    /**
     * @var Personne
     */
    #[ManyToOne(targetEntity: 'App\Entite\Personne')]
    #[Groups(['facture'])]
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
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[Type(type: 'float', message: ValidationMessage::PRIX_NOMBRE)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
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
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }

    public static function init($consoJson, Personne $personneRef)
    {
        $conso = new self();

        $conso->setPersonne($personneRef);
        $conso->setTotal($consoJson->total);

        return $conso;
    }
}