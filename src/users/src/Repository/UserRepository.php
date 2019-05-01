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