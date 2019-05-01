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
     */
    public function __construct(ConfigFactoryInterface $configFactory)
    {
        $this->config = $configFactory->getParser()
            ->parse($configFactory->getFilePath())
        ;
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
