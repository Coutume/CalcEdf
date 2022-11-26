<?php

namespace App\Entite;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table]
class Facture
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private $id;

    #[Column(type: 'datetime')]
    private $date;

    #[Column(type: 'integer')]
    private $consoKwHp;

    #[Column(type: 'integer')]
    private $consoKwHc;

    #[Column(type: 'float')]
    private $prixKwHp;

    #[Column(type: 'float')]
    private $prixKwHc;

    #[Column(type: 'float')]
    private $chargesTva5EurosAboHp;

    #[Column(type: 'float')]
    private $chargesTva5EurosContribAchemElec;

    #[Column(type: 'float')]
    private $chargesTva20TaxeConsoFinale;

    #[Column(type: 'float')]
    private $chargesTva20ContribServPub;

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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getConsoKwHp()
    {
        return $this->consoKwHp;
    }

    /**
     * @param mixed $consoKwHp
     */
    public function setConsoKwHp($consoKwHp): void
    {
        $this->consoKwHp = $consoKwHp;
    }

    /**
     * @return mixed
     */
    public function getConsoKwHc()
    {
        return $this->consoKwHc;
    }

    /**
     * @param mixed $consoKwHc
     */
    public function setConsoKwHc($consoKwHc): void
    {
        $this->consoKwHc = $consoKwHc;
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
}