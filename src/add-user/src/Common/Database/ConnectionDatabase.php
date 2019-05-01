<?php
declare(strict_types=1);

namespace App\Common\Database;

use App\Common\Config\Config;
use App\Common\Config\Factory\DbalConfigProvider;
use App\Common\Config\YmlParser;
use App\Exception\InvalidDbalConfigException;
use App\Exception\InvalidFileConfigException;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
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
     *
     * @throws DBALException
     * @throws InvalidDbalConfigException
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
     */
    private function getConnectionParams(): array
    {
        $configFactory = new Config(new YmlParser(), new DbalConfigProvider());
        $config = $configFactory->getConfig();

        if (!isset($config['dbal']['connection'])) {
            throw new InvalidDbalConfigException('Invalid configuration to connection database');
        }

        return $config;
    }

    /**
     * @return Connection
     * @throws DBALException
     * @throws InvalidDbalConfigException
     */
    private function createConnection(): Connection
    {
        return DriverManager::getConnection($this->getConnectionParams()['dbal']['connection'], new Configuration());
    }
}
