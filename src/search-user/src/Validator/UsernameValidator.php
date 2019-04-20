<?php
declare(strict_types=1);

namespace App\Validator;

/**
 * Class UsernameValidator
 * @package App\validator
 */
class UsernameValidator implements ValidatorInterface
{
    public static function validate($value): bool
    {
        if (!preg_match('/^([A-Z|a-z|0-9]){1,24}$/', $value)) {
            return false;
        }

        return true;
    }
}
