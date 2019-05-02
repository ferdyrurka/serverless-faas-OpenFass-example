<?php
declare(strict_types=1);

namespace App;

use App\Common\Database\ConnectionDatabase;
use App\Exception\HttpException;
use App\Exception\UndefinedTypeException;
use App\Service\CreateUserService;
use App\Service\FindAllUserService;

/**
 * Class Handler
 * @package App
 */
class Handler
{
    /**
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function handle(array $data): string
    {
        try {
            if (!isset($data['type'])) {
                throw new UndefinedTypeException();
            }

            switch ($data['type']) {
                case 'create':
                    $userService = new CreateUserService();
                    $responseModel = $userService->handle($data);
                    break;
                case 'findAll':
                    $userService = new FindAllUserService();
                    $responseModel = $userService->handle($data);
                    break;
                default:
                    throw new UndefinedTypeException();
            }
        } catch (HttpException $httpException) {
            return \json_encode([
                'statusCode' => $httpException->getHttpCode(),
                'body' => $httpException->getMessage()
            ]);
        }

        return \json_encode([
            'statusCode' => $responseModel->getStatusCode(),
            'body' => $responseModel->getBody()
        ]);
    }
}