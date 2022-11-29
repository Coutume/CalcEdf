<?php

namespace App\Entite;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class ConsommationCompteur
{
    /**
     * @var integer
     */
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private $id;

    /**
     * @var Compteur
     */
    #[ManyToOne(targetEntity: 'App\Entite\Compteur')]
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
    private $consoKwHp;

    /**
     * @var integer
     */
    #[Column(type: 'integer')]
    private $consoKwHc;

    /**
     * @var float
     */
    #[Column(type: 'integer')]
    private $consoEuroHp;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $consoEuroHc;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $consoEuroTotalHt;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $consoEuroTotalTtc;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $total;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $valeurPart;

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
    public function setConsoKwHp(int $consoKwHp): void
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
    public function setConsoKwHc(int $consoKwHc): void
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
    public function setConsoEuroHp(float $consoEuroHp): void
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
    public function setConsoEuroHc(float $consoEuroHc): void
    {
        $this->consoEuroHc = $consoEuroHc;
    }

    /**
     * @return float
     */
    public function getConsoEuroTotalHt(): float
    {
        return $this->consoEuroTotalHt;
    }

    /**
     * @param float $consoEuroTotalHt
     */
    public function setConsoEuroTotalHt(float $consoEuroTotalHt): void
    {
        $this->consoEuroTotalHt = $consoEuroTotalHt;
    }

    /**
     * @return float
     */
    public function getConsoEuroTotalTtc(): float
    {
        return $this->consoEuroTotalTtc;
    }

    /**
     * @param float $consoEuroTotalTtc
     */
    public function setConsoEuroTotalTtc(float $consoEuroTotalTtc): void
    {
        $this->consoEuroTotalTtc = $consoEuroTotalTtc;
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
    public function setTotal(float $total): void
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
    public function setValeurPart(float $valeurPart): void
    {
        $this->valeurPart = $valeurPart;
    }
}