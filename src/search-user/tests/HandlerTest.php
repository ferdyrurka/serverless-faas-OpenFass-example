<?php
declare(strict_types=1);

namespace App\Tests;

use App\Exception\InvalidArgsException;
use App\Exception\NotFoundException;
use App\Handler;
use App\Service\JsonResponse;
use App\Service\UserService;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * Class HandlerTest
 * @package App\Tests
 */
class HandlerTest extends TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /**
     * @var Handler
     */
    private $handler;

    /**
     * @var int
     */
    private $statusCode = 200;

    /**
     * @var bool
     */
    private $success = true;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->handler = new Handler();

        $jsonResponse = Mockery::mock('overload:' . JsonResponse::class);
        $jsonResponse->shouldReceive('__construct')
            ->withArgs(
                function (array $message, bool $success = true, int $statusCode = 200): bool {
                    if (empty($message) || $success !== $this->success || $statusCode !== $this->statusCode) {
                        return false;
                    }

                    return true;
                }
            )
        ;
        $jsonResponse->shouldReceive('getContent')->once()->andReturn('JSON RESPONSE');
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function notRequiredParameters(): void
    {
        $this->statusCode = 400;
        $this->success = false;
        $this->handler->handle(\json_encode([]));
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function notFoundException(): void
    {
        $this->success = false;
        $this->statusCode = 404;

        $notFoundException = Mockery::mock(NotFoundException::class);
        $notFoundException->shouldReceive('getStatusCode')->once()->andReturn($this->statusCode);

        $userService = Mockery::mock('overload:' . UserService::class);
        $userService->shouldReceive('searchUser')->withArgs(['Ferdyrurka'])->once()
            ->andThrow($notFoundException)
        ;

        $this->handler->handle(\json_encode(['username' => 'Ferdyrurka']));
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function invalidArgsException(): void
    {
        $this->success = false;
        $this->statusCode = 400;

        $invalidArgsException = Mockery::mock(InvalidArgsException::class);
        $invalidArgsException->shouldReceive('getStatusCode')->once()->andReturn($this->statusCode);

        $userService = Mockery::mock('overload:' . UserService::class);
        $userService->shouldReceive('searchUser')->withArgs(['Ferdyrurka'])->once()
            ->andThrow($invalidArgsException)
        ;

        $this->handler->handle(\json_encode(['username' => 'Ferdyrurka']));
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function handleOk(): void
    {
        $userService = Mockery::mock('overload:' . UserService::class);
        $userService->shouldReceive('searchUser')->withArgs(['Ferdyrurka'])->once()
            ->andReturn(['age' => 20])
        ;

        $this->handler->handle(\json_encode(['username' => 'Ferdyrurka']));
    }
}
