<?php

namespace App\Controleur;

use DI\Annotation\Inject;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CommonController
{
    /**
     * @Inject(name="entityManager")
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @Inject(name="serializer")
     * @var Serializer
     */
    protected $serializer;


    public function __construct()
    {
        $this->validator = $this->initValidator();
    }

    protected function initValidator()
    {
        $validation = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();

        return $validation;
    }

    protected function erreurValidationReponse(ConstraintViolationListInterface $erreurs, ResponseInterface $response)
    {
        $retourErreur = static::_jsonResponse(true, 'validation', implode(', ', array_map(function(ConstraintViolationInterface $c) {return $c->getMessage();}, iterator_to_array($erreurs))));

        $response->getBody()->write(json_encode($retourErreur));
        return $response->withStatus(400);
    }

    public static function erreurReponse($message, ResponseInterface $response)
    {
        $retourErreur = static::_jsonResponse(true, 'validation', $message);

        $response->getBody()->write(json_encode($retourErreur));
        return $response->withStatus(500);
    }

    protected static function _jsonResponse($error, $type, $message)
    {
        return ['erreur' => $error, 'type' => $type, 'message' => $message];
    }
}