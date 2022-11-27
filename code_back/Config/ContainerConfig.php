<?php

namespace App\Config;

use Psr\Container\ContainerInterface;

/**
 * Représente la configuration globale du conteneur de dépendance de l'application
 */
class ContainerConfig
{
    public static function initContainer()
    {
        // Create Container using PHP-DI
        $builder = new \DI\ContainerBuilder();
        $builder->useAnnotations(true); // Injection des dépendances via annotation @Inject dans les classes à instancier
        $builder->useAutowiring(true); // Injection automatique des dépendances (si c'est possible)
        $container = $builder->build();

        $container->set('entityManager', function(ContainerInterface $container)
        {
            return $container->get('App\Database\Connexion')->initEntityManager();
        });

        return $container;
    }
}