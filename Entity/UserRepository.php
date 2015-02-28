<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Vardius\Bundle\UserBundle\Entity\UserRepository
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class UserRepository extends EntityRepository
{
    public function findUserByUsernameOrEmail($username)
    {
        return $this
            ->createQueryBuilder('u')
            ->select('u, r')
            ->leftJoin('u.roles', 'r')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
