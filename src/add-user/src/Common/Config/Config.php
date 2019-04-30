<?php
declare(strict_types=1);

namespace App\Common\Config;

use App\Common\Config\Factory\ConfigFactoryInterface;
use App\Exception\InvalidFileConfigException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Config
 * @package App\Common\Config
 */
class Config
{
    /**
     * @var array|null
     */
    private $config;

    /**
     * Config constructor.
     * @param ConfigFactoryInterface $configFactory
     * @throws InvalidFileConfigException
     */
    public function __construct(ConfigFactoryInterface $configFactory)
    {
        $this->config = $this->parseConfig($configFactory->getFilePath());
    }

    /**
     * @param string $pathFile
     * @return array|null
     * @throws InvalidFileConfigException
     */
    private function parseConfig(string $pathFile): ?array
    {
        if (!file_exists($pathFile)) {
            throw new InvalidFileConfigException('Config file doesn\'t exist by path: ' . $pathFile);
        }

        return Yaml::parseFile($pathFile);
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        if (empty($this->config)) {
            return [];
        }

        return $this->config;
    }
}
