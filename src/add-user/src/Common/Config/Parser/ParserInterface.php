<?php


namespace App\Common\Config;

interface ParserInterface
{
    public function parseConfig(string $pathFile): ?array;
}