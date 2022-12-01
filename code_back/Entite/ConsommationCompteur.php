<?php

namespace App\Entite;

use App\Config\ValidationMessage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Type;

#[Entity]
class ConsommationCompteur
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
     * @var Compteur
     */
    #[ManyToOne(targetEntity: 'App\Entite\Compteur')]
    #[Groups(['facture'])]
    private $compteur;

    /**
     * @var Facture
     */
    #[ManyToOne(targetEntity: 'App\Entite\Facture', inversedBy: 'consommationsCompteur')]
    private $facture;

    /**
     * @var integer
     */
    #[Column(type: 'integer')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[Type(type: 'integer', message: ValidationMessage::KW_NOMBRE)]
    #[PositiveOrZero(message: ValidationMessage::KW_NOMBRE)]
    #[Groups(['facture'])]
    private $consoKwHp;

    /**
     * @var integer
     */
    #[Column(type: 'integer')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[Type(type: 'integer', message: ValidationMessage::KW_NOMBRE)]
    #[PositiveOrZero(message: ValidationMessage::KW_NOMBRE)]
    #[Groups(['facture'])]
    private $consoKwHc;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $consoEuroHp;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $consoEuroHc;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $consoEuroTotal;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $total;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $valeurPart;

    /**
     * @var DetailConsommationCompteur[]|Collection
     */
    #[OneToMany(mappedBy: 'consommationCompteur', targetEntity: 'App\Entite\DetailConsommationCompteur', cascade: ['persist'])]
    private $detailsConsommationCompteur;

    public function __construct()
    {
        $this->detailsConsommationCompteur = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCompteur()
    {
        return $this->compteur;
    }

    /**
     * @param mixed $compteur
     */
    public function setCompteur($compteur): void
    {
        $this->compteur = $compteur;
    }

    /**
     * @return mixed
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * @param mixed $facture
     */
    public function setFacture($facture): void
    {
        $this->facture = $facture;
    }

    /**
     * @return int
     */
    public function getConsoKwHp(): int
    {
        return $this->consoKwHp;
    }

    /**
     * @param int $consoKwHp
     */
    public function setConsoKwHp($consoKwHp): void
    {
        $this->consoKwHp = $consoKwHp;
    }

    /**
     * @return int
     */
    public function getConsoKwHc(): int
    {
        return $this->consoKwHc;
    }

    /**
     * @param int $consoKwHc
     */
    public function setConsoKwHc($consoKwHc): void
    {
        $this->consoKwHc = $consoKwHc;
    }

    /**
     * @return float
     */
    public function getConsoEuroHp(): float
    {
        return $this->consoEuroHp;
    }

    /**
     * @param float $consoEuroHp
     */
    public function setConsoEuroHp($consoEuroHp): void
    {
        $this->consoEuroHp = $consoEuroHp;
    }

    /**
     * @return float
     */
    public function getConsoEuroHc(): float
    {
        return $this->consoEuroHc;
    }

    /**
     * @param float $consoEuroHc
     */
    public function setConsoEuroHc($consoEuroHc): void
    {
        $this->consoEuroHc = $consoEuroHc;
    }

    /**
     * @return float
     */
    public function getConsoEuroTotal(): float
    {
        return $this->consoEuroTotal;
    }

    /**
     * @param float $consoEuroTotal
     */
    public function setConsoEuroTotal($consoEuroTotal): void
    {
        $this->consoEuroTotal = $consoEuroTotal;
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

    /**
     * @return float
     */
    public function getValeurPart(): float
    {
        return $this->valeurPart;
    }

    /**
     * @param float $valeurPart
     */
    public function setValeurPart($valeurPart): void
    {
        $this->valeurPart = $valeurPart;
    }

    public function addDetailConsommationCompteur(DetailConsommationCompteur $detailConsommationCompteur)
    {
        $detailConsommationCompteur->setConsommationCompteur($this);
        $this->detailsConsommationCompteur->add($detailConsommationCompteur);
    }

    public static function init($consommation, Compteur $compteur)
    {
        $conso = new self();

        $conso->setCompteur($compteur);
        $conso->setConsoKwHp($consommation->consoKwHp);
        $conso->setConsoKwHc($consommation->consoKwHc);
        $conso->setConsoEuroHp($consommation->consoEurosHp);
        $conso->setConsoEuroHc($consommation->consoEurosHc);
        $conso->setConsoEuroTotal($consommation->consoEurosTotal);
        $conso->setTotal($consommation->total);
        $conso->setValeurPart($consommation->valeurPart);

        foreach($consommation->lignesBudgetaires as $detail)
        {
            $conso->addDetailConsommationCompteur(DetailConsommationCompteur::init($detail));
        }

        return $conso;
    }
}