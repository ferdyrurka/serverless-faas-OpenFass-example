<?php
declare(strict_types=1);

namespace App\Tests\Common\Database;

use App\Common\Config\Config;
use App\Common\Config\Factory\DbalConfigFactory;
use App\Common\Database\ConnectionDatabase;
use App\Exception\InvalidDbalConfigException;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use PHPUnit\Framework\TestCase;
use \Mockery;

class ConnectionDatabaseTest extends TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /**
     * @var Config
     */
    private $config;

    protected function setUp(): void
    {
        $this->configFactory = Mockery::mock('overload:' . Config::class);
        $this->configFactory->shouldReceive('__construct')->withArgs([DbalConfigFactory::class]);
    }

    /**
     * @throws InvalidDbalConfigException
     * @throws \App\Exception\InvalidFileConfigException
     * @throws \Doctrine\DBAL\DBALException
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function invalidDbalConfigException(): void
    {
        $this->configFactory->shouldReceive('getConfig')->once()->andReturnNull();

        $this->expectException(InvalidDbalConfigException::class);
        new ConnectionDatabase();
    }

    /**
     * @throws InvalidDbalConfigException
     * @throws \App\Exception\InvalidFileConfigException
     * @throws \Doctrine\DBAL\DBALException
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function connectionOk(): void
    {
        $this->configFactory->shouldReceive('getConfig')->once()->andReturn([true]);

        $driverManager = Mockery::mock('alias:' . DriverManager::class);
        $driverManager->shouldReceive('getConnection')
            ->withArgs(
                function (array $args, object $conf): bool {
                    if (!$conf instanceof Configuration ||
                        !isset($args[0]) ||
                        !$args[0]
                    ) {
                        return false;
                    }

                    return true;
                }
            )
            ->once()
            ->andReturn(Mockery::mock(Connection::class))
        ;

        $connectionDatabase = new ConnectionDatabase();
        $this->assertInstanceOf(Connection::class, $connectionDatabase->getConnection());
    }
}
