<?php

namespace App\Controleur;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CommonController
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;
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

    protected function erreurReponse($message, ResponseInterface $response)
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