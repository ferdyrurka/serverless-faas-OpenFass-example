<?php
declare(strict_types=1);

namespace App\Validator;

/**
 * Interface ValidatorInterface
 * @package App\validator
 */
interface ValidatorInterface
{
    /**
     * @param $value
     * @return bool
     */
    public static function validate($value): bool;
}
