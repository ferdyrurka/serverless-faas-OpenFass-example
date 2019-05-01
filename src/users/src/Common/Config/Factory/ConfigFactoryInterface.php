<?php
declare(strict_types=1);

namespace App\Common\Config\Factory;

use App\Common\Parser\ParserInterface;

/**
 * Interface ConfigFactory
 * @package App\Common\Config\Component
 */
interface ConfigFactoryInterface
{
    /**
     * @return string
     */
    public static function getFilePath(): string;

    /**
     * @return ParserInterface
     */
    public static function getParser(): ParserInterface;
}
