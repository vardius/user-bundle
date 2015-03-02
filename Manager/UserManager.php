<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Vardius\Bundle\UserBundle\Entity\UserRepository;

/**
 * Vardius\Bundle\UserBundle\Entity\UserManager
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class UserManager implements UserManagerInterface
{
    /** @var UserRepository */
    protected $repository;
    /** @var bool */
    protected $addUsername;

    /**
     * @param EntityManager $entityManager
     * @param string $class
     * @param boolean $addUsername
     */
    function __construct(EntityManager $entityManager, $class, $addUsername)
    {
        $class = $class ?: 'VardiusUserBundle:User';
        $repository = $entityManager->getRepository($class);

        if (!$repository instanceof UserRepository) {
            throw new UnsupportedUserException(sprintf('Expected an instance of Vardius\Bundle\UserBundle\Entity\UserRepository, but got "%s".', get_class($repository)));
        }

        $this->repository = $repository;
        $this->addUsername = $addUsername;
    }

    /**
     * @inheritDoc
     */
    public function findUserByUsernameOrEmail($username)
    {
        return $this->repository->findUserByUsernameOrEmail($username);
    }

    /**
     * @inheritDoc
     */
    public function findUserById($id)
    {
        return $this->repository->findOneById($id);
    }

    /**
     * @inheritDoc
     */
    public function findUserBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * @inheritDoc
     */
    public function getUserCLass()
    {
        return $this->repository->getClassName();
    }

    /**
     * @inheritDoc
     */
    public function addUsername()
    {
        return $this->addUsername;
    }

    /**
     * @inheritDoc
     */
    public function getRepository()
    {
        return $this->repository;
    }

}
