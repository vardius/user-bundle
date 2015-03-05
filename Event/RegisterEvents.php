<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */


namespace Vardius\Bundle\UserBundle\Event;

/**
 * RegisterEvents
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
final class RegisterEvents
{
    /**
     * The register.pre.persist event is thrown each time an user is registered
     *
     * The event listener receives an
     * Vardius\Bundle\UserBundle\Event\RegisterEvent instance.
     *
     * @var string
     */
    const REGISTER_PRE_PERSIST = 'register.pre.persist';

    /**
     * The register.post.persist event is thrown each time an user is registered
     *
     * The event listener receives an
     * Vardius\Bundle\UserBundle\Event\RegisterEvent instance.
     *
     * @var string
     */
    const REGISTER_POST_PERSIST = 'register.post.persist';
}
