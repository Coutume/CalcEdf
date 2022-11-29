<?php

namespace App\Entite;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
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
    #[Column(type: 'float')]
    private $prixKwHp;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $prixKwHc;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $chargesTva5EurosAboHp;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $chargesTva5EurosContribAchemElec;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $chargesTva20TaxeConsoFinale;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $total;

    /**
     * @var float
     */
    #[Column(type: 'float')]
    private $chargesTva20ContribServPub;

    #[OneToMany(mappedBy: 'facture', targetEntity: 'App\Entite\ConsommationCompteur')]
    private $consommationsCompteur;

    #[OneToMany(mappedBy: 'facture', targetEntity: '\App\Entite\ConsommationPersonne')]
    private $consommationsPersonne;

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
     * @return mixed
     */
    public function getConsommationsCompteur()
    {
        return $this->consommationsCompteur;
    }

    /**
     * @param mixed $consommationsCompteur
     */
    public function setConsommationsCompteur($consommationsCompteur): void
    {
        $this->consommationsCompteur = $consommationsCompteur;
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
    public function setConsommationsPersonne($consommationsPersonne): void
    {
        $this->consommationsPersonne = $consommationsPersonne;
    }

    public static function init($factureJson)
    {
        $facture = new self();

        $facture->setDate(\DateTime::createFromFormat('Y-m-d', $factureJson->saisies->dateFacture)
            ->setTime(0, 0, 0));
        $facture->setConsoKwHp($factureJson->saisies->consoKwHp);
        $facture->setConsoKwHc($factureJson->saisies->consoKwHc);
        $facture->setPrixKwHp($factureJson->saisies->prixKwHp);
        $facture->setPrixKwHc($factureJson->saisies->prixKwHc);
        $facture->setChargesTva5EurosAboHp($factureJson->saisies->chargesTva5EurosAboHp);
        $facture->setChargesTva5EurosContribAchemElec($factureJson->saisies->chargesTva5EurosContribAchemElec);
        $facture->setChargesTva20TaxeConsoFinale($factureJson->saisies->chargesTva20TaxeConsoFinale);
        $facture->setChargesTva20ContribServPub($factureJson->saisies->chargesTva20ContribServPub);

        return $facture;
    }
}