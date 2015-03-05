<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Vardius\Bundle\UserBundle\Entity\User;

/**
 * RegisterEvent
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class RegisterEvent extends Event
{
    /** @var User */
    protected $user;

    /**
     * @param User $user
     */
    function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

}
