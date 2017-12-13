<?php

namespace InboxAgency\User\Repository;

use Doctrine\DBAL\Connection;
use InboxAgency\User\Entity\User;

/**
 * @codeCoverageIgnore
 */
class DBALUserRepository implements UserRepositoryInterface
{
    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    public function findByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email = :email';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('email', $email);
        $stmt->execute();

        $user = false;
        $userData = $stmt->fetch();

        if ($userData) {
            $user = new User();
            $user->fromArray($userData);
        }

        return $user;
    }
}
