<?php
declare(strict_types=1);

namespace App\Tests\Common\Config;

use App\Common\Config\Config;
use App\Common\Config\Factory\ConfigFactoryInterface;
use App\Common\Parser\ParserInterface;
use App\Common\Parser\YamlParser;
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
     * @var ParserInterface
     */
    private $parserInterface;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->configFactoryInterface = Mockery::mock(ConfigFactoryInterface::class);
        $this->parserInterface = Mockery::mock(ParserInterface::class);
    }

    /**
     * @test
     */
    public function getConfigEmpty(): void
    {
        $this->parserInterface->shouldReceive('parse')->withArgs(['./composer.json'])->once()
            ->andReturn([])
        ;

        $this->configFactoryInterface->shouldReceive('getFilePath')->once()->andReturn('./composer.json');
        $this->configFactoryInterface->shouldReceive('getParser')->once()->andReturn($this->parserInterface);

        $config = new Config($this->configFactoryInterface);
        $configResult = $config->getConfig();

        $this->assertEmpty($configResult);
    }

    /**
     * @test
     */
    public function getConfigOk(): void
    {
        $this->parserInterface->shouldReceive('parse')->withArgs(['./composer.json'])->once()
            ->andReturn(['ok'])
        ;

        $this->configFactoryInterface->shouldReceive('getFilePath')->once()->andReturn('./composer.json');
        $this->configFactoryInterface->shouldReceive('getParser')->once()->andReturn($this->parserInterface);

        $config = new Config($this->configFactoryInterface);
        $configResult = $config->getConfig();

        $this->assertNotEmpty($configResult);
    }
}
