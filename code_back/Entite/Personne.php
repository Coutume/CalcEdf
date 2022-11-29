<?php

namespace App\Entite;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;

#[Entity]
class Personne
{
    /**
     * @var integer
     */
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private $id;

    /**
     * @var string
     */
    #[Column(type: 'string', length: 100)]
    private $nom;

    /**
     * @var string
     */
    #[Column(type: 'string', length: 100)]
    private $prenom;

    /**
     * @var Compteur
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
     * @return Compteur
     */
    public function getCompteurs(): Compteur
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