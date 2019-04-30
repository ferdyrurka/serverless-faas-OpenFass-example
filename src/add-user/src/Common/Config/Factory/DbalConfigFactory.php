<?php
declare(strict_types=1);

namespace App\Common\Config\Factory;

/**
 * Class DbalConfigFactory
 * @package App\Common\Config\Component
 */
class DbalConfigFactory implements ConfigFactory
{
    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return './config/dbal.yml';
    }
}
