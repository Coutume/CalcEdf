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
}