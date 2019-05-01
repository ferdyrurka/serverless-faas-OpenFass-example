<?php
declare(strict_types=1);

namespace App\Common\Parser;

use App\Exception\InvalidFileConfigException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlParser
 * @package App\Common\Parser
 */
class YamlParser implements ParserInterface
{
    /**
     * @param string $filePath
     * @return array|null
     * @throws InvalidFileConfigException
     */
    public function parse(string $filePath): ?array
    {
        if (!file_exists($filePath)) {
            throw new InvalidFileConfigException('Config file doesn\'t exist by path: ' . $filePath);
        }

        return Yaml::parseFile($filePath);
    }
}
