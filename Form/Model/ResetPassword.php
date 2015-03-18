<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Vardius\Bundle\UserBundle\Form\Model\ResetPassword
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ResetPassword
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}
