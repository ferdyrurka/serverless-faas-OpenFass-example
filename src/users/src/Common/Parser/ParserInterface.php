<?php
declare(strict_types=1);

namespace App\Common\Parser;

/**
 * Interface ParserInterface
 * @package App\Common\Parser
 */
interface ParserInterface
{
    /**
     * @param string $filePath
     * @return array|null
     */
    public function parse(string $filePath): ?array;
}
