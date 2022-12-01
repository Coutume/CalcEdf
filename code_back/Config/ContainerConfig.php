<?php

namespace App\Config;

use Doctrine\Common\Annotations\AnnotationReader;
use Psr\Container\ContainerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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

        // Init du serializer : utilise les getters / propriétés publiques de l'objet et le paramétrage des attributs
        $container->set('serializer', function(ContainerInterface $container)
        {
            $encoders = [new JsonEncoder()];
            $normalizers = [new DateTimeNormalizer(), new ObjectNormalizer(new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader())))];

            return new Serializer($normalizers, $encoders);
        });

        return $container;
    }
}