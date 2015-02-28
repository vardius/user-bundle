<?php
/**
 * This file is part of the zamocno package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Manager;


use Doctrine\ORM\EntityManager;
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

    /**
     * @param EntityManager $entityManager
     */
    function __construct(EntityManager $entityManager)
    {
        $this->repository = $entityManager->getRepository('VardiusUserBundle:User');
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

}
