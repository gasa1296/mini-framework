<?php
namespace Core;

use Symfony\Component\Yaml\Yaml;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Clase Abstracta para los repositorios
 * @author Gabriel Segovia (gabriel.asa.1296@gmail.com)
 */
abstract class Repository
{
    protected Connection $connection;
    protected QueryBuilder $querybuilder;

    public function __construct()
    {
        $connectionParams = Yaml::parseFile(__DIR__ . '/../config/database.yaml');
        $this->connection = DriverManager::getConnection($connectionParams);
        $this->querybuilder = $this->connection->createQueryBuilder();
    }
}
