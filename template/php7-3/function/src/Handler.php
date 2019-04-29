<?php
declare(strict_types=1);

namespace App;

/**
 * Class Handler
 * @package App
 */
class Handler
{
    /**
     * @param array $data
     * @return string
     */
    public function handle(array $data): string {
        return \json_encode($data);
    }
}