<?php

namespace App\Database;

use App\Config\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;
use PDO;
use PDOException;
use TypeError;

class Connexion
{
    private $user;

    private $password;

    private $hostname;

    private $db;

    private $dsn;

    public function __construct(Configuration $config)
    {
        $this->user = $config->getConfig("user");
        $this->password = $config->getConfig("password");
        $this->hostname = $config->getConfig("hostname");
        $this->db = $config->getConfig("db");

        $this->dsn = sprintf('pgsql:dbname=%s;host=%s', $this->db, $this->hostname);
    }

    public function getConnexion()
    {
        try {
            $username = $this->user;
            $password = $this->password;

            // Connect to the database
            $conn = new PDO(
                $this->dsn,
                $username,
                $password,
            # ...
            );

            return $conn;
        } catch (TypeError $e) {
            throw new \Exception(
                sprintf(
                    'Invalid or missing configuration! Make sure you have set ' .
                    '$username, $password, $dbName, and $instanceHost (for TCP mode). ' .
                    'The PHP error was %s',
                    $e->getMessage()
                )
            );
        } catch (PDOException $e) {
            throw new \Exception(
                sprintf(
                    'Could not connect to the Cloud SQL Database. Check that ' .
                    'your username and password are correct, that the Cloud SQL ' .
                    'proxy is running, and that the database exists and is ready ' .
                    'for use. For more assistance, refer to %s. The PDO error was %s',
                    'https://cloud.google.com/sql/docs/postgres/connect-external-app',
                    $e->getMessage()
                )
            );
        }
    }

    /**
     * @return ?EntityManager
     * @throws ORMException
     */
    public function initEntityManager() : ?EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: array(__DIR__."/../Entite"),
            isDevMode: true,
        );

        $conn = array(
            'driver' => 'pdo_pgsql',
            'user' => $this->user,
            'password' => $this->password,
            'host' => $this->hostname,
            'dbname' => $this->db
        );

        return EntityManager::create($conn, $config);
    }
}