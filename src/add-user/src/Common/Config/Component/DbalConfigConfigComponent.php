<?php
declare(strict_types=1);

namespace App\Common\Config\Component;

/**
 * Class DbalConfigConfigComponent
 * @package App\Common\Config\Component
 */
class DbalConfigConfigComponent implements ConfigComponentInterface
{
    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return './config/dbal.yml';
    }
}
