<?php

namespace App\Exception;

/**
 * Class InvalidFileConfigException
 * @package App\Exception
 */
class InvalidFileConfigException extends HttpException
{
    /**
     * InvalidFileConfigException constructor.
     * @param string $message
     */
    public function __construct($message = '')
    {
        parent::__construct($message, 500, 'Internal server error.');
    }
}