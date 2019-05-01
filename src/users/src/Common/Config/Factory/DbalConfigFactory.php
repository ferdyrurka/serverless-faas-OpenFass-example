<?php
declare(strict_types=1);

namespace App\Common\Config\Factory;

use App\Common\Parser\ParserInterface;
use App\Common\Parser\YamlParser;

/**
 * Class DbalConfigFactory
 * @package App\Common\Config\Component
 */
class DbalConfigFactory implements ConfigFactoryInterface
{
    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return './function/config/dbal.yml';
    }

    /**
     * @return ParserInterface
     */
    public function getParser(): ParserInterface
    {
        return new YamlParser();
    }
}
