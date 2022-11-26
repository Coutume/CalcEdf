<?php

namespace App\Config;

use Exception;

class Configuration
{
    private $config;

    public function __construct()
    {
        $this->config = parse_ini_file(__DIR__ . '/../../config/app.ini');

        if($this->config === false)
        {
            throw new Exception("Fichier de configuration app.ini introuvable");
        }
    }

    public function getConfig($cle)
    {
        return $this->config[$cle];
    }
}