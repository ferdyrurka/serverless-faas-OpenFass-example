<?php

namespace App\Tests;

use App\Common\Model\ResponseModel;
use App\Exception\UndefinedTypeException;
use App\Handler;
use App\Service\CreateUserService;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use \Mockery;

/**
 * Class HandlerTest
 * @package App\Tests
 */
class HandlerTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var Handler
     */
    private $handler;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->handler = new Handler();
    }

    /**
     * @throws UndefinedTypeException
     * @test
     */
    public function notTypeInRequestException(): void
    {
        $json = $this->handler->handle([]);
        $this->assertEquals(500, \json_decode($json, true)['statusCode']);
    }

    /**
     * @throws UndefinedTypeException
     * @test
     */
    public function undefinedTypeException(): void
    {
        $json = $this->handler->handle(['type' => 'UNDEFINED!!']);
        $this->assertEquals(500, \json_decode($json, true)['statusCode']);
    }

    /**
     * @throws UndefinedTypeException
     * @test
     * @runInSeparateProcess
     */
    public function handleCreateUser(): void
    {
        $responseModel = Mockery::mock(ResponseModel::class);
        $responseModel->shouldReceive('getStatusCode')->once()->andReturn(200);
        $responseModel->shouldReceive('getBody')->once()->andReturn(['success' => true]);

        $createUserService = Mockery::mock('overload:' . CreateUserService::class);
        $createUserService->shouldReceive('handle')->once()->withArgs(
            function (array $data): bool {
                if (!isset($data['username'], $data['type'])) {
                    return false;
                }

                return true;
            }
        )
            ->andReturn($responseModel)
        ;

        $this->handler->handle(
            [
                'type' => 'create',
                'username' => 'UsernameValue'
            ]
        );
    }
}
