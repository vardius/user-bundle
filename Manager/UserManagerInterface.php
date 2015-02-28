<?php
/**
 * This file is part of the zamocno package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Manager;
use Vardius\Bundle\UserBundle\Entity\User;


/**
 * Vardius\Bundle\UserBundle\Entity\UserManagerInterface
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
interface UserManagerInterface
{
    /**
     * Return User object or null by username
     *
     * @param string $username
     * @return User|null
     */
    public function findUserByUsernameOrEmail($username);

    /**
     * Returns User object by id
     * @param $id
     * @return User|null
     */
    public function findUserById($id);

    /**
     * @param array $criteria
     * @return User|null
     */
    public function findUserBy(array $criteria);

    /**
     * Return user class
     *
     * @return string
     */
    public function getUserCLass();
}
