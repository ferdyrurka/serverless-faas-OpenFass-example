<?php
declare(strict_types=1);

namespace App\Common\Validator;

/**
 * Interface DataValidatorInterface
 * @package App\Common\Validator
 */
interface DataValidatorInterface
{
    /**
     * @param array $data
     * @return bool
     */
    public function validate(array $data): bool;

    /**
     * @return array
     */
    public function getErrors(): array;
}
