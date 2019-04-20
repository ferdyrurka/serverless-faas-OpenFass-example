<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Exception\InvalidArgsException;
use App\Exception\NotFoundException;
use App\Service\UserService;
use App\Validator\UsernameValidator;
use \Mockery;
use PHPUnit\Framework\TestCase;

/**
 * Class UserServiceTest
 * @package App\Tests\Service
 */
class UserServiceTest extends TestCase
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->userService = new UserService();
    }


    /**
     * @throws InvalidArgsException
     * @throws NotFoundException
     * @test
     * @runInSeparateProcess
     */
    public function searchUserInvalidUsername(): void
    {
        $usernameValidator = Mockery::mock('alias:' . UsernameValidator::class);
        $usernameValidator->shouldReceive('validate')->withArgs(['FERDYRURKA'])
            ->once()->andReturnFalse()
        ;

        $this->expectException(InvalidArgsException::class);
        $this->userService->searchUser('FERDYRURKA');
    }

    /**
     * @throws InvalidArgsException
     * @throws NotFoundException
     * @test
     * @runInSeparateProcess
     */
    public function searchUserUsernameNotFound(): void
    {
        $usernameValidator = Mockery::mock('alias:' . UsernameValidator::class);
        $usernameValidator->shouldReceive('validate')->withArgs(['NOTFOUND'])
            ->once()->andReturnTrue()
        ;

        $this->expectException(NotFoundException::class);
        $this->userService->searchUser('NOTFOUND');
    }

    /**
     * @throws InvalidArgsException
     * @throws NotFoundException
     * @test
     * @runInSeparateProcess
     */
    public function searchUserOk(): void
    {
        $usernameValidator = Mockery::mock('alias:' . UsernameValidator::class);
        $usernameValidator->shouldReceive('validate')->withArgs(['Ferdyrurka'])
            ->once()->andReturnTrue()
        ;

        $result = $this->userService->searchUser('Ferdyrurka');

        $this->assertEquals(20, $result['age']);
    }
}

