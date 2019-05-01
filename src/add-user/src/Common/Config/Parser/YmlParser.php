<?php


namespace App\Common\Config;

use App\Exception\InvalidFileConfigException;
use Symfony\Component\Yaml\Yaml;

class YmlParser implements ParserInterface
{
    /**
     * @param string $pathFile
     * @return array|null
     * @throws InvalidFileConfigException
     */
    public function parseConfig(string $pathFile): ?array
    {
        if (!file_exists($pathFile)) {
            throw new InvalidFileConfigException('Config file doesn\'t exist by path: ' . $pathFile);
        }

        return Yaml::parseFile($pathFile);
    }
}