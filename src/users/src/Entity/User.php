<?php
declare(strict_types=1);

namespace App\Entity;

use \DateTime;

/**
 * Class User
 * @package App\Entity
 */
class User
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * User constructor.
     * @param string $username
     * @param string $createdAt
     */
    public function __construct(string $username, string $createdAt)
    {
        $this->username = $username;
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
