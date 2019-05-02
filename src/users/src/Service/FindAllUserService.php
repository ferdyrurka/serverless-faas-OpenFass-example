<?php
declare(strict_types=1);

namespace App\Service;

use App\Common\Model\ResponseModel;
use App\Repository\UserRepository;

/**
 * Class FindAllUserService
 * @package App\Service
 */
class FindAllUserService implements UserServiceInterface
{
    /**
     * @param array $data
     * @return ResponseModel
     */
    public function handle(array $data): ResponseModel
    {
        $userRepository = new UserRepository();
        return new ResponseModel(200, $userRepository->findAll());
    }
}
