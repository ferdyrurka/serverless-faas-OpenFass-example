<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Common\Validator\CreateUserDataValidator;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\CreateUserService;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use \Mockery;

/**
 * Class CreateUserServiceTest
 * @package App\Tests\Service
 */
class CreateUserServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var CreateUserService
     */
    private $createUserService;

    /**
     * @var CreateUserDataValidator
     */
    private $createUserDataValidator;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->createUserService = new CreateUserService();
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function validateFailed(): void
    {
        $this->setUpCreateUserDataValidator(false);
        $this->createUserDataValidator->shouldReceive('getErrors')->once()->andReturn([]);

        $responseModel = $this->createUserService->handle(['username' => 'UsernameValue']);
        $this->assertEquals(400, $responseModel->getStatusCode());
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function handleOk(): void
    {
        $this->setUpCreateUserDataValidator(true);

        $userRepository = Mockery::mock('overload:' . UserRepository::class);
        $userRepository->shouldReceive('save')->withArgs(
            function (User $user): bool {
                if ($user->getUsername() !== 'usernamevalue') {
                    return false;
                }

                return true;
            }
        )->once();

        $responseModel = $this->createUserService->handle(['username' => 'UsernameValue']);
        $this->assertEquals(200, $responseModel->getStatusCode());
        $this->assertTrue($responseModel->getBody()['success']);
    }

    /**
     * @param bool $returnValidate
     */
    private function setUpCreateUserDataValidator(bool $returnValidate): void
    {
        $this->createUserDataValidator = Mockery::mock('overload:' . CreateUserDataValidator::class);
        $this->createUserDataValidator->shouldReceive('validate')->withArgs(
            function (array $args): bool {
                if (!isset($args['username']) ||
                    $args['username'] !== 'UsernameValue'
                ){
                    return false;
                }

                return true;
            }
        )
            ->once()
            ->andReturn($returnValidate)
        ;
    }
}
