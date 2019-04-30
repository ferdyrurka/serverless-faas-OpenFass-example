<?php
declare(strict_types=1);

namespace App\Common\Config\Factory;

/**
 * Interface ConfigFactory
 * @package App\Common\Config\Component
 */
interface ConfigFactoryInterface
{
    /**
     * @return string
     */
    public function getFilePath(): string;
}
