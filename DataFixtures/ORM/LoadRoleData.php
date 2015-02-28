<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vardius\Bundle\UserBundle\Entity\Role;

/**
 * Vardius\Bundle\UserBundle\DataFixtures\ORM\LoadRoleData
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class LoadRoleData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userRole = $manager->getRepository('VardiusUserBundle:Role')->findOneByRole('ROLE_USER');
        if (!$userRole) {
            $role = new Role();
            $role->setName('user');
            $role->setRole('ROLE_USER');
            $manager->persist($role);
        }

        $userRole = $manager->getRepository('VardiusUserBundle:Role')->findOneByRole('ROLE_ADMIN');
        if (!$userRole) {
            $role = new Role();
            $role->setName('admin');
            $role->setRole('ROLE_ADMIN');
            $manager->persist($role);
        }

        $userRole = $manager->getRepository('VardiusUserBundle:Role')->findOneByRole('ROLE_ALLOWED_TO_SWITCH');
        if (!$userRole) {
            $role = new Role();
            $role->setName('allowed to switch');
            $role->setRole('ROLE_ALLOWED_TO_SWITCH');
            $manager->persist($role);
        }

        $userRole = $manager->getRepository('VardiusUserBundle:Role')->findOneByRole('ROLE_SUPER_ADMIN');
        if (!$userRole) {
            $role = new Role();
            $role->setName('super admin');
            $role->setRole('ROLE_SUPER_ADMIN');
            $manager->persist($role);
        }

        $manager->flush();
    }
}
