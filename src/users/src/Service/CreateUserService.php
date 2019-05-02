<?php
declare(strict_types=1);

namespace App\Service;

use App\Common\Model\ResponseModel;
use App\Common\Validator\CreateUserDataValidator;
use App\Entity\User;
use App\Repository\UserRepository;
use \DateTime;

/**
 * Class CreateUserService
 * @package App\Service
 */
class CreateUserService implements UserServiceInterface
{
    /**
     * @param array $data
     * @return ResponseModel
     * @throws \Exception
     */
    public function handle(array $data): ResponseModel
    {
        $createUserDataValidator = new CreateUserDataValidator();
        if (!$createUserDataValidator->validate($data)) {
            return new ResponseModel(400, $createUserDataValidator->getErrors());
        }

        $userRepository = new UserRepository();
        $username = strtolower($data['username']);

        if ($userRepository->getCountByUsername($username) > 0) {
            return new ResponseModel(400, ['User is created!']);
        }

        $date = new DateTime('now');
        $user = new User($username, $date->getTimestamp());

        $userRepository->save($user);

        return new ResponseModel(200, ['success' => true]);
    }
}
