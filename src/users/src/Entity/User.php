<?php
declare(strict_types=1);

namespace App\Entity;

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
     * @var integer
     */
    private $createdAt;

    /**
     * User constructor.
     * @param string $username
     * @param int $createdAt
     */
    public function __construct(string $username, int $createdAt)
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
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }
}
