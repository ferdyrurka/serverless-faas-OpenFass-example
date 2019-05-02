<?php
declare(strict_types=1);

namespace App\Repository;

use App\Common\Database\ConnectionDatabase;
use App\Entity\User;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository
{
    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $connectionDatabase = new ConnectionDatabase();
        $this->queryBuilder = $connectionDatabase->getConnection()->createQueryBuilder();
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->queryBuilder
            ->select('u.username, u.created_at')
            ->from('users', 'u')
            ->execute()
            ->fetchAll()
        ;
    }

    /**
     * @param string $username
     * @return int
     */
    public function getCountByUsername(string $username): int
    {
        return $this->queryBuilder
            ->select('count(u.id)')
            ->from('users', 'u')
            ->where('u.username = ?')
            ->setParameter(0, $username)
            ->execute()
            ->rowCount()
        ;
    }

    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        $this->queryBuilder
            ->insert('users')
            ->values([
                'username' => '?',
                'created_at' => '?'
            ])
            ->setParameter(0, $user->getUsername())
            ->setParameter(1, $user->getCreatedAt())
            ->execute()
        ;
    }
}