<?php
declare(strict_types=1);

namespace App\Tests\Common\Validator;

use App\Common\Validator\CreateUserDataValidator;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use \Mockery;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CreateUserDataValidatorTest
 * @package App\Tests\Common\Validator
 */
class CreateUserDataValidatorTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var CreateUserDataValidator
     */
    private $createUserDataValidator;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->createUserDataValidator = new CreateUserDataValidator();
    }

    /**
     * @test
     */
    public function notRequiredParameters(): void
    {
        $this->assertFalse(
            $this->createUserDataValidator->validate([])
        );
        $this->assertNotEmpty(
            $this->createUserDataValidator->getErrors()
        );
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disable
     */
    public function validatorFailed(): void
    {
        $violation = Mockery::mock(ConstraintViolationInterface::class);
        $violation->shouldReceive('getMessage')->once()->andReturn('Message');

        $this->setUpValidator([$violation]);

        $this->assertFalse(
            $this->createUserDataValidator->validate(
                [
                    'username' => 'UsernameValue'
                ]
            )
        );
        $this->assertNotEmpty(
            $this->createUserDataValidator->getErrors()
        );
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disable
     */
    public function validateOk(): void
    {
        $this->setUpValidator();

        $this->assertTrue(
            $this->createUserDataValidator->validate(
                [
                    'username' => 'UsernameValue'
                ]
            )
        );
        $this->assertEmpty(
            $this->createUserDataValidator->getErrors()
        );
    }

    /**
     * @param array $returnValidate
     */
    private function setUpValidator(array $returnValidate = []): void
    {
        $validator = Mockery::mock(ValidatorInterface::class);
        $validator->shouldReceive('validate')->once()
            ->withArgs(
                function (string $username, array $constraints): bool {
                    if ($username !== 'UsernameValue' ||
                        !isset($constraints[0], $constraints[1], $constraints[2]) ||
                        !$constraints[0] instanceof Length ||
                        !$constraints[1] instanceof NotBlank ||
                        !$constraints[2] instanceof Regex
                    ) {
                        return false;
                    }

                    return true;
                }
            )
            ->andReturn($returnValidate)
        ;

        $validation = Mockery::mock('alias:' . Validation::class);
        $validation->shouldReceive('createValidator')->once()
            ->andReturn($validator)
        ;
    }
}
