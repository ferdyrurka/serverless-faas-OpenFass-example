<?php
declare(strict_types=1);

namespace App\Exception;

/**
 * Class InvalidArgsException
 * @package App\Exception
 */
class InvalidArgsException extends SearchUserException
{
    /**
     * InvalidArgsException constructor.
     */
    public function __construct()
    {
        parent::__construct('Invalid arguments!');
    }
}
