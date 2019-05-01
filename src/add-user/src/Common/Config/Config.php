<?php
declare(strict_types=1);

namespace App\Common\Config;

use App\Common\Config\Factory\DbalConfigProvider;

/**
 * Class Config
 *
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
     *
     * @param ParserInterface    $parser
     * @param DbalConfigProvider $configProvider
     *
     */
    public function __construct(ParserInterface $parser, DbalConfigProvider $configProvider)
    {
        $this->config = $parser->parseConfig($configProvider->getFilePath());
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
