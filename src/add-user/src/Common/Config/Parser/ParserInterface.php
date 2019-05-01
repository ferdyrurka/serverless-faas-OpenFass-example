<?php
declare(strict_types=1);

namespace App\Common\Config;

interface ParserInterface
{
    public function parseConfig(string $pathFile): ?array;
}