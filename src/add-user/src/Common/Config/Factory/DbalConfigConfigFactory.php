<?php
declare(strict_types=1);

namespace App\Common\Config\Factory;

/**
 * Class DbalConfigConfigFactory
 * @package App\Common\Config\Component
 */
class DbalConfigConfigFactory implements ConfigComponentFactory
{
    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return './config/dbal.yml';
    }
}
