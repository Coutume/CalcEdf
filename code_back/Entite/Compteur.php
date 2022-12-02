<?php

namespace App\Entite;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Serializer\Annotation\Groups;

#[Entity]
class Compteur
{

    /**
     * @var ?integer
     */
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    #[Groups(['facture'])]
    private $id;

    /**
     * @var ?string
     */
    #[Column(type: 'string', length: 100)]
    #[Groups(['facture'])]
    private $nom;

    /**
     * @var ?Compteur
     */
    #[ManyToOne(targetEntity: 'App\Entite\Compteur')]
    #[Groups(['facture'])]
    private $compteurParent;

    /**
     * @var ?boolean
     */
    #[Column(type: 'boolean')]
    #[Groups(['facture'])]
    private $partageTaxes;

    /**
     * @var string
     */
    #[Column(type: 'string', length: 50, nullable: true)]
    #[Groups(['facture'])]
    private $couleurGraphique;

    /**
     * @var ?Personne[]|Collection
     */
    #[ManyToMany(targetEntity: 'App\Entite\Personne', mappedBy: 'compteurs')]
    #[Groups(['facture'])]
    private $personnes;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getNom(): ?string
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
     * @return Compteur|null
     */
    public function getCompteurParent(): ?Compteur
    {
        return $this->compteurParent;
    }

    /**
     * @param Compteur $compteurParent
     */
    public function setCompteurParent(Compteur $compteurParent): void
    {
        $this->compteurParent = $compteurParent;
    }

    /**
     * @return bool|null
     */
    public function getPartageTaxes(): ?bool
    {
        return $this->partageTaxes;
    }

    /**
     * @param bool|null $partageTaxes
     */
    public function setPartageTaxes($partageTaxes): void
    {
        $this->partageTaxes = $partageTaxes;
    }

    /**
     * @return ?Personne[]
     */
    public function getPersonnes(): ?Collection
    {
        return $this->personnes;
    }

    /**
     * @param Personne[] $personnes
     */
    public function setPersonnes($personnes): void
    {
        $this->personnes = $personnes;
    }

    /**
     * @return string
     */
    public function getCouleurGraphique(): string
    {
        return $this->couleurGraphique;
    }

    /**
     * @param string $couleurGraphique
     */
    public function setCouleurGraphique(string $couleurGraphique): void
    {
        $this->couleurGraphique = $couleurGraphique;
    }
}