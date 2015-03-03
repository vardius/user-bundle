<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Vardius\Bundle\UserBundle\Entity\UserInterface
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
interface UserInterface
{
    /**
     * @return integer
     */
    public function getId();

    /**
     * @param $username
     * @return $this
     */
    public function setUsername($username);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email);

    /**
     * @return mixed
     */
    public function getPlainPassword();

    /**
     * @param string $password
     */
    public function setPlainPassword($password);

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password);

    /**
     * @param $role
     * @return $this
     */
    public function addRole($role);

    /**
     * @param ArrayCollection $roles
     * @return $this
     */
    public function setRoles(ArrayCollection $roles);

    /**
     * @param string $role
     * @return bool
     */
    public function hasRole($role);

    /**
     * @param string $role
     * @return $this
     */
    public function removeRole($role);

    /**
     * @return bool
     */
    public function isCredentialsExpired();

    /**
     * @param boolean $boolean
     *
     * @return User
     */
    public function setCredentialsExpired($boolean);

    /**
     * @return bool
     */
    public function isExpired();

    /**
     * @param $boolean
     * @return $this
     */
    public function setExpired($boolean);

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setExpiresAt(\DateTime $date = null);

    /**
     * @return bool
     */
    public function isLocked();

    /**
     * @param $boolean
     * @return $this
     */
    public function setLocked($boolean);

    /**
     * @return string
     */
    public function __toString();
}
