<?php
declare(strict_types=1);

namespace App\Tests\Common\Parser;

use App\Common\Parser\YamlParser;
use App\Exception\InvalidFileConfigException;
use \Mockery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlParserTest
 * @package App\Tests\Common\Parser
 */
class YamlParserTest extends TestCase
{
    /**
     * @var YamlParser
     */
    private $yamlParser;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->yamlParser = new YamlParser();
    }


    /**
     * @test
     */
    public function undefinedFile(): void
    {
        $this->expectException(InvalidFileConfigException::class);
        $this->yamlParser->parse('FAILED');
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disable
     */
    public function parseOk(): void
    {
        $yamlParser = Mockery::mock('alias:' . Yaml::class);
        $yamlParser->shouldReceive('parseFile')->once()->andReturn(['some' => 'parse']);

        $parse = $this->yamlParser->parse('composer.json');
        $this->assertEquals('parse', $parse['some']);
    }
}
