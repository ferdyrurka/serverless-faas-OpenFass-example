<?php
declare(strict_types=1);

namespace App\Exception;

/**
 * Class UserNotFoundException
 * @package App\Exception
 */
class NotFoundException extends SearchUserException
{
    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return 404;
    }
}
