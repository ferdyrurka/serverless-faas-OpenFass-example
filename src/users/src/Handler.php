<?php
declare(strict_types=1);

namespace App;

use App\Common\Database\ConnectionDatabase;

/**
 * Class Handler
 * @package App
 */
class Handler
{
    /**
     * @param array $data
     * @return string
     * @throws Exception\InvalidDbalConfigException
     * @throws Exception\InvalidFileConfigException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function handle(array $data): string {
        $connectionDatabase = new ConnectionDatabase();
        $connection = $connectionDatabase->getConnection();

        return \json_encode(['Hello']);
    }
}