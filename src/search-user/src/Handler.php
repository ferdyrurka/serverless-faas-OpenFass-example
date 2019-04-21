<?php

namespace App;

use App\Exception\InvalidArgsException;
use App\Exception\NotFoundException;
use App\Service\JsonResponse;
use App\Service\UserService;

/**
 * Class Handler
 * @package App
 */
class Handler
{
    /**
     * @param $data
     * @return string
     */
    public function handle(string $data): string
    {
        $dataArray = json_decode($data, true);

        if (!isset($dataArray['username'])) {
            $jsonResponse = new JsonResponse(['error' => 'Don\'t you send required parameters!'], false, 400);
            return $jsonResponse->getContent();
        }

        $userService = new UserService();
        try {
            $jsonResponse = new JsonResponse($userService->searchUser($dataArray['username']));
        } catch (NotFoundException | InvalidArgsException $exception) {
            $jsonResponse = new JsonResponse(['error' => $exception->getMessage()], false, $exception->getStatusCode());
        }

        return $jsonResponse->getContent();
    }
}
