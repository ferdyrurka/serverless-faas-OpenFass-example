<?php
declare(strict_types=1);

namespace App\Tests;

use App\Handler;
use PHPUnit\Framework\TestCase;

/**
 * Class HandlerTest
 * @package App\Tests
 */
class HandlerTest extends TestCase
{
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
     * @test
     */
    public function handleOk(): void
    {
        $jsonResult = $this->handler->handle(['success' => true]);
        $arrayResult = \json_decode($jsonResult, true);

        $this->assertTrue($arrayResult['success']);
    }
}
