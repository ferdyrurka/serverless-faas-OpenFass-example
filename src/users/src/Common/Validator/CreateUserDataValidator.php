<?php
declare(strict_types=1);

namespace App\Common\Validator;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;

class CreateUserDataValidator implements DataValidatorInterface
{
    /**
     * @var array
     */
    private $errors = [];

    public function validate(array $data): bool
    {
        if (!isset($data['username'])) {
            $this->errors[] = 'Username is required parameters!';

            return false;
        }

        $validator = Validation::createValidator();
        $violations = $validator->validate($data['username'], [
            new Length(
                [
                   'min' => 6,
                   'minMessage' => 'Minimum username length is 6 chars',
                   'max' => 64,
                   'maxMessage' => 'Maximum username length is 6 chars',
                ]
            ),
            new NotBlank(),
            new Regex(
                [
                    'pattern' => '/^([A-Z|a-z|0-9]){6,64}$/'
                ]
            )
        ]);

        if (\count($violations) !== 0) {
            foreach ($violations as $violation) {
                $this->errors[] = $violation->getMessage();
            }

            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
