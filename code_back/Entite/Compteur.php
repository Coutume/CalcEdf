<?php

namespace App\Entite;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class Compteur
{

    /**
     * @var ?integer
     */
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private $id;

    /**
     * @var ?string
     */
    #[Column(type: 'string', length: 100)]
    private $nom;

    /**
     * @var ?Compteur
     */
    #[ManyToOne(targetEntity: 'App\Entite\Compteur')]
    private $compteurParent;

    /**
     * @var ?boolean
     */
    #[Column(type: 'boolean')]
    private $partageTaxes;

    /**
     * @var ?Personne[]
     */
    #[ManyToMany(targetEntity: 'App\Entite\Personne', mappedBy: 'compteurs')]
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
    public function getPersonnes(): ?array
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


}