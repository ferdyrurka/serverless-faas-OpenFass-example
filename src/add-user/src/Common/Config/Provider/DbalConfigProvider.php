<?php
declare(strict_types=1);

namespace App\Common\Config\Factory;

/**
 * Class DbalConfigFactory
 * @package App\Common\Config\Component
 */
class DbalConfigProvider
{
    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return './function/config/dbal.yml';
    }
}
