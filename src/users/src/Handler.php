<?php
declare(strict_types=1);

namespace App;

use App\Common\Database\ConnectionDatabase;
use App\Common\Model\ResponseModel;
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

            $responseModel = $this->handleService($data);
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

    /**
     * @param array $data
     * @return ResponseModel
     * @throws UndefinedTypeException
     */
    private function handleService(array $data): ResponseModel
    {
        switch ($data['type']) {
            case 'create':
                $userService = new CreateUserService();
                break;
            case 'findAll':
                $userService = new FindAllUserService();
                break;
            default:
                throw new UndefinedTypeException();
        }

        return $userService->handle($data);
    }
}
