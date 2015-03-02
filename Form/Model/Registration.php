<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Vardius\Bundle\UserBundle\Entity\User;

/**
 * Vardius\Bundle\UserBundle\Form\Model\Registration
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class Registration
{
    /**
     * @var User
     *
     * @Assert\Type(type="Vardius\Bundle\UserBundle\Entity\User")
     * @Assert\Valid()
     */
    protected $user;

    /**
     * @var boolean
     * @Assert\True()
     */
    protected $termsAccepted;

    /**
     * @param User $user
     */
    public function setUser(User $user)
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

    /**
     * @return bool
     */
    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    /**
     * @param $termsAccepted
     */
    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (Boolean)$termsAccepted;
    }
}
