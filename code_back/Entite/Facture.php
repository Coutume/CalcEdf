<?php

namespace App\Entite;

use App\Config\ValidationMessage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Type;

#[Entity(repositoryClass: '\App\Repository\FactureRepository')]
class Facture
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    #[Groups(['facture'])]
    private $id;

    #[Column(type: 'datetime')]
    #[NotNull(message: ValidationMessage::DATE_RENSEIGNEE)]
    #[Type(type: '\DateTime', message: ValidationMessage::DATE_RENSEIGNEE)]
    #[Groups(['facture'])]
    #[Context(context: ['datetime_format' => 'Y-m-d'])]
    private $dateFacture;

    /**
     * @var integer[]
     */
    #[Column(type: 'simple_array')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[Groups(['facture'])]
    private $consosKwHp;

    /**
     * @var integer[]
     */
    #[Column(type: 'simple_array')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[Groups(['facture'])]
    private $consosKwHc;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $prixKwHp;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $prixKwHc;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $chargesTva5EurosAboHp;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $chargesTva5EurosContribAchemElec;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $chargesTva20TaxeConsoFinale;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $chargesTva20ContribServPub;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    #[NotNull(message: ValidationMessage::VALEUR)]
    #[PositiveOrZero(message: ValidationMessage::PRIX_NOMBRE)]
    #[Groups(['facture'])]
    private $total;

    /**
     * @var Collection
     */
    #[OneToMany(mappedBy: 'facture', targetEntity: 'App\Entite\ConsommationCompteur', cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[NotNull(message: ValidationMessage::VALEUR_TECH)]
    #[Groups(['facture'])]
    private $consommationsCompteur;

    /**
     * @var Collection
     */
    #[OneToMany(mappedBy: 'facture', targetEntity: '\App\Entite\ConsommationPersonne', cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[NotNull(message: ValidationMessage::VALEUR_TECH)]
    #[Groups(['facture'])]
    private $consommationsPersonne;

    public function __construct()
    {
        $this->consommationsCompteur = new ArrayCollection();
        $this->consommationsPersonne = new ArrayCollection();
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
    public function getDateFacture()
    {
        return $this->dateFacture;
    }

    /**
     * @param mixed $dateFacture
     */
    public function setDateFacture($dateFacture): void
    {
        $this->dateFacture = $dateFacture;
    }

    /**
     * @return mixed
     */
    public function getConsosKwHp()
    {
        return $this->consosKwHp;
    }

    /**
     * @param mixed $consosKwHp
     */
    public function setConsosKwHp($consosKwHp): void
    {
        $this->consosKwHp = $consosKwHp;
    }

    /**
     * @return mixed
     */
    public function getConsosKwHc()
    {
        return $this->consosKwHc;
    }

    /**
     * @param mixed $consosKwHc
     */
    public function setConsosKwHc($consosKwHc): void
    {
        $this->consosKwHc = $consosKwHc;
    }

    /**
     * @return mixed
     */
    public function getPrixKwHp()
    {
        return $this->prixKwHp;
    }

    /**
     * @param mixed $prixKwHp
     */
    public function setPrixKwHp($prixKwHp): void
    {
        $this->prixKwHp = $prixKwHp;
    }

    /**
     * @return mixed
     */
    public function getPrixKwHc()
    {
        return $this->prixKwHc;
    }

    /**
     * @param mixed $prixKwHc
     */
    public function setPrixKwHc($prixKwHc): void
    {
        $this->prixKwHc = $prixKwHc;
    }

    /**
     * @return mixed
     */
    public function getChargesTva5EurosAboHp()
    {
        return $this->chargesTva5EurosAboHp;
    }

    /**
     * @param mixed $chargesTva5EurosAboHp
     */
    public function setChargesTva5EurosAboHp($chargesTva5EurosAboHp): void
    {
        $this->chargesTva5EurosAboHp = $chargesTva5EurosAboHp;
    }

    /**
     * @return mixed
     */
    public function getChargesTva5EurosContribAchemElec()
    {
        return $this->chargesTva5EurosContribAchemElec;
    }

    /**
     * @param mixed $chargesTva5EurosContribAchemElec
     */
    public function setChargesTva5EurosContribAchemElec($chargesTva5EurosContribAchemElec): void
    {
        $this->chargesTva5EurosContribAchemElec = $chargesTva5EurosContribAchemElec;
    }

    /**
     * @return mixed
     */
    public function getChargesTva20TaxeConsoFinale()
    {
        return $this->chargesTva20TaxeConsoFinale;
    }

    /**
     * @param mixed $chargesTva20TaxeConsoFinale
     */
    public function setChargesTva20TaxeConsoFinale($chargesTva20TaxeConsoFinale): void
    {
        $this->chargesTva20TaxeConsoFinale = $chargesTva20TaxeConsoFinale;
    }

    /**
     * @return mixed
     */
    public function getChargesTva20ContribServPub()
    {
        return $this->chargesTva20ContribServPub;
    }

    /**
     * @param mixed $chargesTva20ContribServPub
     */
    public function setChargesTva20ContribServPub($chargesTva20ContribServPub): void
    {
        $this->chargesTva20ContribServPub = $chargesTva20ContribServPub;
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
     * @return mixed
     */
    public function getConsommationsCompteur()
    {
        return $this->consommationsCompteur;
    }

    /**
     * @param mixed $consommationsCompteur
     */
    public function addConsommationsCompteur(ConsommationCompteur $consommationsCompteur): void
    {
        $consommationsCompteur->setFacture($this);
        $this->consommationsCompteur->add($consommationsCompteur);
    }

    /**
     * @return mixed
     */
    public function getConsommationsPersonne()
    {
        return $this->consommationsPersonne;
    }

    /**
     * @param mixed $consommationsPersonne
     */
    public function addConsommationsPersonne(ConsommationPersonne $consommationsPersonne): void
    {
        $consommationsPersonne->setFacture($this);
        $this->consommationsPersonne->add($consommationsPersonne);
    }

    /**
     * @param ArrayCollection|Collection $consommationsCompteur
     */
    public function setConsommationsCompteur(ArrayCollection|Collection $consommationsCompteur): void
    {
        foreach($consommationsCompteur as $cc)
        {
            $this->addConsommationsCompteur($cc);
        }
    }

    /**
     * @param ArrayCollection|Collection $consommationsPersonne
     */
    public function setConsommationsPersonne(ArrayCollection|Collection $consommationsPersonne): void
    {
        foreach($consommationsPersonne as $cp)
        {
            $this->addConsommationsPersonne($cp);
        }
    }
}