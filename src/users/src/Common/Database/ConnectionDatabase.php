<?php
declare(strict_types=1);

namespace App\Common\Database;

use App\Common\Config\Config;
use App\Common\Config\Factory\DbalConfigFactory;
use App\Exception\InvalidDbalConfigException;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

/**
 * Class ConnectionDatabase
 * @package App\Common\Database
 */
class ConnectionDatabase
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * ConnectionDatabase constructor.
     * @throws InvalidDbalConfigException
     * @throws \App\Exception\InvalidFileConfigException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function __construct()
    {
        $this->connection = $this->createConnection();
    }

    /**
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return $this->connection;
    }

    /**
     * @return array
     * @throws InvalidDbalConfigException
     * @throws \App\Exception\InvalidFileConfigException
     */
    private function getConnectionParams(): array
    {
        $configFactory = new Config(new DbalConfigFactory());
        $config = $configFactory->getConfig();

        if (!isset($config['dbal']['connection'])) {
            throw new InvalidDbalConfigException('Invalid configuration to connection database');
        }

        return $config;
    }

    /**
     * @return Connection
     * @throws InvalidDbalConfigException
     * @throws \App\Exception\InvalidFileConfigException
     * @throws \Doctrine\DBAL\DBALException
     */
    private function createConnection(): Connection
    {
        return DriverManager::getConnection($this->getConnectionParams()['dbal']['connection'], new Configuration());
    }
}
