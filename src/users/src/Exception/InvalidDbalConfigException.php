<?php
declare(strict_types=1);

namespace App\Exception;

/**
 * Class InvalidDbalConfigException
 * @package App\Exception
 */
class InvalidDbalConfigException extends HttpException
{
    /**
     * InvalidDbalConfigException constructor.
     * @param string $message
     */
    public function __construct($message = '')
    {
        parent::__construct($message, 500, 'Internal server error.');
    }
}
