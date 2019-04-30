<?php
declare(strict_types=1);

namespace App\Tests\Common\Config;

use App\Common\Config\Config;
use App\Common\Config\Factory\ConfigFactoryInterface;
use App\Exception\InvalidFileConfigException;
use \Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigTest
 * @package App\Tests\Common\Config
 */
class ConfigTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var ConfigFactoryInterface
     */
    private $configFactoryInterface;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->configFactoryInterface = Mockery::mock(ConfigFactoryInterface::class);
    }

    /**
     * @throws InvalidFileConfigException
     * @test
     */
    public function undefinedFile(): void
    {
        $this->configFactoryInterface->shouldReceive('getFilePath')->once()->andReturn('./FAILED');

        $this->expectException(InvalidFileConfigException::class);
        new Config($this->configFactoryInterface);
    }

    /**
     * @throws InvalidFileConfigException
     * @test
     * @runInSeparateProcess
     */
    public function getConfigEmpty(): void
    {
        $this->configFactoryInterface->shouldReceive('getFilePath')->once()->andReturn('./composer.json');

        $yamlParser = Mockery::mock('alias:' . Yaml::class);
        $yamlParser->shouldReceive('parseFile')->once()->andReturn([]);

        $config = new Config($this->configFactoryInterface);
        $configResult = $config->getConfig();

        $this->assertEmpty($configResult);
    }

    /**
     * @throws InvalidFileConfigException
     * @test
     * @runInSeparateProcess
     */
    public function getConfigOk(): void
    {
        $this->configFactoryInterface->shouldReceive('getFilePath')->once()->andReturn('./composer.json');

        $yamlParser = Mockery::mock('alias:' . Yaml::class);
        $yamlParser->shouldReceive('parseFile')->once()->andReturn(['some' => 'config']);

        $config = new Config($this->configFactoryInterface);
        $configResult = $config->getConfig();

        $this->assertNotEmpty($configResult);
    }
}
