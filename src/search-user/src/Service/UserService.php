<?php
declare(strict_types=1);

namespace App\Service;

use App\Exception\InvalidArgsException;
use App\Exception\NotFoundException;
use App\Validator\UsernameValidator;

/**
 * Class UserService
 * @package App\Service
 */
class UserService
{
    /**
     * @param string $username
     * @return array
     * @throws InvalidArgsException
     * @throws NotFoundException
     */
    public function searchUser(string $username) : array
    {
        if (!UsernameValidator::validate($username)) {
            throw new InvalidArgsException();
        }

        if ($username !== 'Ferdyrurka') {
            throw new NotFoundException('User not found by username: ' . $username);
        }

        return [
            'age' => 20
        ];
    }
}
