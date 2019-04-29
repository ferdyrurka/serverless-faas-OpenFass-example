<?php
declare(strict_types=1);

namespace App\Common\Config\Factory;

/**
 * Interface ConfigComponentFactory
 * @package App\Common\Config\Component
 */
interface ConfigComponentFactory
{
    /**
     * @return string
     */
    public function getFilePath(): string;
}
