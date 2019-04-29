<?php

namespace App\Common\Config\Component;

/**
 * Interface ConfigComponentInterface
 * @package App\Common\Config\Component
 */
interface ConfigComponentInterface
{
    /**
     * @return string
     */
    public function getFilePath(): string;
}
