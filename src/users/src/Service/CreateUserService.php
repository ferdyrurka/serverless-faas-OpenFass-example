<?php
declare(strict_types=1);

namespace App\Service;

use App\Common\Model\ResponseModel;
use App\Common\Validator\CreateUserDataValidator;
use App\Entity\User;
use App\Repository\UserRepository;
use \DateTime;

class CreateUserService implements UserServiceInterface
{
    public function handle(array $data): ResponseModel
    {
        $createUserDataValidator = new CreateUserDataValidator();
        if (!$createUserDataValidator->validate($data)) {
            return new ResponseModel(400, $createUserDataValidator->getErrors());
        }

        $date = new DateTime('now');
        $user = new User($data['username'], $date->getTimestamp());

        $userRepository = new UserRepository();
        $userRepository->save($user);

        return new ResponseModel(200, ['success' => true]);
    }
}
