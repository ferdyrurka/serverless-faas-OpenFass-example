<?php
declare(strict_types=1);

namespace App\Service;

use App\Common\Model\ResponseModel;

/**
 * Interface UserServiceInterface
 * @package App\Service
 */
interface UserServiceInterface
{
    /**
     * @param array $data
     * @return ResponseModel
     */
    public function handle(array $data): ResponseModel;
}
