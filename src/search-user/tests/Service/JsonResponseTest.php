<?php
declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\JsonResponse;
use PHPUnit\Framework\TestCase;

/**
 * Class JsonResponseTest
 * @package App\Tests\Service
 */
class JsonResponseTest extends TestCase
{
    /**
     * @test
     */
    public function responseTest(): void {
        $message = ['Hello World'];
        $statusCode = 304;
        $success = false;

        $jsonResponse = new JsonResponse($message, $success, $statusCode);
        $contentArray = \json_decode($jsonResponse->getContent(), true);

        $this->assertEquals($message[0], $contentArray['message'][0]);
        $this->assertEquals(304, $contentArray['statusCode']);
        $this->assertFalse($contentArray['success']);
    }
}

