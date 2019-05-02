<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Repository\UserRepository;
use App\Service\FindAllUserService;
use PHPUnit\Framework\TestCase;
use \Mockery;

/**
 * Class FindAllUserServiceTest
 * @package App\Tests\Service
 */
class FindAllUserServiceTest extends TestCase
{
    /**
     * @var FindAllUserService
     */
    private $searchUserService;

    /**
     *
     */
    protected function setUp(): void
    {
        $this->searchUserService = new FindAllUserService();
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function findAll(): void
    {
        $userRepository = Mockery::mock('overload:' . UserRepository::class);
        $userRepository->shouldReceive('findAll')->once()
            ->andReturn(['user first'])
        ;

        $responseModel = $this->searchUserService->handle([]);
        $this->assertEquals(200, $responseModel->getStatusCode());
        $this->assertNotEmpty($responseModel->getBody());
    }
}
