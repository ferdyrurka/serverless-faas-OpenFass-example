<?php

namespace App\Exception;

/**
 * Class InvalidConfigException
 * @package App\Exception
 */
class InvalidConfigException extends HttpException
{
    /**
     * InvalidConfigException constructor.
     * @param string $message
     */
    public function __construct($message = '')
    {
        parent::__construct($message, 500);
    }
}