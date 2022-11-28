<?php

namespace App\Config;

use Exception;
use Symfony\Component\Dotenv\Dotenv;

class Configuration
{
    private $config;

    public function __construct()
    {
        $isDev = str_contains($_SERVER['SERVER_NAME'], 'localhost');

        $fichierEnv = '.env.' . ($isDev ? 'development' : 'production');
        $dotenv = new Dotenv();
        $dotenv->loadEnv(__DIR__ . '/../../' . $fichierEnv);
    }

    public function getConfig($cle)
    {
        return $_ENV[$cle];
    }
}