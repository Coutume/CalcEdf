<?php

namespace App\Entite;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

#[Entity]
class Personne
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
     * @var string
     */
    #[Column(type: 'string', length: 100)]
    #[Groups(['facture'])]
    private $nom;

    /**
     * @var string
     */
    #[Column(type: 'string', length: 100)]
    #[Groups(['facture'])]
    private $prenom;

    /**
     * @var Compteur[]|Collection
     */
    #[ManyToMany(targetEntity: 'App\Entite\Compteur', inversedBy: 'personnes')]
    private $compteurs;

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
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return Compteur[]|Collection
     */
    public function getCompteurs(): ?Collection
    {
        return $this->compteurs;
    }

    /**
     * @param Compteur $compteurs
     */
    public function setCompteurs(Compteur $compteurs): void
    {
        $this->compteurs = $compteurs;
    }
}