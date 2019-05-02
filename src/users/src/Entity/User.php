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
     * @var int|null
     */
    private $id;

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
     * @param int|null $id
     */
    public function __construct(string $username, int $createdAt, int $id = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
