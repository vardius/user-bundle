<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Manager;

use Vardius\Bundle\UserBundle\Entity\User;
use Vardius\Bundle\UserBundle\Entity\UserRepository;

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

    /**
     * @param $class
     * @return boolean
     */
    public function supportsClass($class);

    /**
     * @return boolean
     */
    public function addUsername();

    /**
     * @return UserRepository
     */
    public function getRepository();
}
