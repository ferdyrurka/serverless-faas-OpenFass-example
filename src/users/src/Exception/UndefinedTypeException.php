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
        parent::__construct('Undefined function by type', 500);
    }
}
