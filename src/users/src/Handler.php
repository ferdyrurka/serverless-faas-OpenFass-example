<?php
declare(strict_types=1);

namespace App;

use App\Common\Database\ConnectionDatabase;
use App\Exception\HttpException;
use App\Exception\UndefinedTypeException;
use App\Service\CreateUserService;

/**
 * Class Handler
 * @package App
 */
class Handler
{
    /**
     * @param array $data
     * @return string
     * @throws UndefinedTypeException
     */
    public function handle(array $data): string {
        try {
            if (!isset($data['type'])) {
                throw new UndefinedTypeException();
            }

            switch ($data['type']) {
                case 'create':
                    $userService = new CreateUserService();
                    $responseModel = $userService->handle($this->clearData($data));
                    break;
                default:
                    throw new UndefinedTypeException();
            }
        } catch (HttpException $httpException) {
            return \json_encode([
                'statusCode' => $httpException->getHttpCode(),
                'body' => $httpException->getHttpMessage()
            ]);
        }

        return \json_encode([
            'statusCode' => $responseModel->getStatusCode(),
            'body' => $responseModel->getBody()
        ]);
    }

    private function clearData(array $data): array
    {
        unset($data['type']);

        return $data;
    }
}