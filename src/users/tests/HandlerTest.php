<?php

namespace App\Tests;

use App\Common\Model\ResponseModel;
use App\Handler;
use App\Service\CreateUserService;
use App\Service\FindAllUserService;
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
     * @var ResponseModel
     */
    private $responseModel;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->handler = new Handler();
    }

    /**
     * @throws \Exception
     * @test
     */
    public function notTypeInRequestException(): void
    {
        $json = $this->handler->handle([]);
        $this->assertEquals(500, \json_decode($json, true)['statusCode']);
    }

    /**
     * @throws \Exception
     * @test
     */
    public function undefinedTypeException(): void
    {
        $json = $this->handler->handle(['type' => 'UNDEFINED!!']);
        $this->assertEquals(500, \json_decode($json, true)['statusCode']);
    }

    /**
     * @throws \Exception
     * @test
     * @runInSeparateProcess
     */
    public function handleCreateUser(): void
    {
        $this->setUpResponseModel();

        $createUserService = Mockery::mock('overload:' . CreateUserService::class);
        $createUserService->shouldReceive('handle')->once()->withArgs(
            function (array $data): bool {
                if (!isset($data['username'], $data['type'])) {
                    return false;
                }

                return true;
            }
        )
            ->andReturn($this->responseModel)
        ;

        $this->handler->handle(
            [
                'type' => 'create',
                'username' => 'UsernameValue'
            ]
        );
    }

    /**
     * @throws \Exception
     * @test
     * @runInSeparateProcess
     */
    public function handleFindAll(): void
    {
        $this->setUpResponseModel();

        $createUserService = Mockery::mock('overload:' . FindAllUserService::class);
        $createUserService->shouldReceive('handle')->once()->withArgs(
            function (array $data): bool {
                if (!isset($data['type'])) {
                    return false;
                }

                return true;
            }
        )
            ->andReturn($this->responseModel)
        ;

        $this->handler->handle(['type' => 'findAll']);
    }

    /**
     *
     */
    private function setUpResponseModel(): void
    {
        $this->responseModel = Mockery::mock(ResponseModel::class);
        $this->responseModel->shouldReceive('getStatusCode')->once()->andReturn(200);
        $this->responseModel->shouldReceive('getBody')->once()->andReturn(['success' => true]);
    }
}
