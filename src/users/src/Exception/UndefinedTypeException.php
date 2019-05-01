<?php
declare(strict_types=1);

namespace App\Exception;

/**
 * Class UndefinedTypeException
 * @package App\Exception
 */
class UndefinedTypeException extends HttpException
{
    /**
     * UndefinedTypeException constructor.
     */
    public function __construct()
    {
        $message = 'Undefined function by type';
        parent::__construct($message, 500, $message);
    }
}
