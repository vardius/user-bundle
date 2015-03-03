<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Vardius\Bundle\UserBundle\Manager\UserManagerInterface;
use Vardius\Bundle\UserBundle\Entity\User;

/**
 * Vardius\Bundle\UserBundle\Security\User\UserProvider
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class UserProvider implements UserProviderInterface
{
    /**
     * @var UserManagerInterface
     */
    protected $userManager;

    /**
     * Constructor.
     *
     * @param UserManagerInterface $userManager
     */
    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    public function loadUserByUsername($username)
    {
        $user = $this->userManager->findUserByUsernameOrEmail($username);

        if (!$user) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }

        return $user;

    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        if (!$this->supportsClass(get_class($user))) {
            throw new UnsupportedUserException(sprintf('Expected an instance of %s, but got "%s".', $this->userManager->getUserCLass(), get_class($user)));
        }

        $refreshedUser = $this->userManager->findUserById($user->getId());
        if (null === $refreshedUser) {
            throw new UsernameNotFoundException(sprintf('User with ID "%d" could not be refreshed.', $user->getId()));
        }

        return $refreshedUser;
    }

    public function supportsClass($class)
    {
        return $this->userManager->supportsClass($class);
    }

}
