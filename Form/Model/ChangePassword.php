<?php
/**
 * This file is part of the zamocno package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Form\Model;


use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;
use Vardius\Bundle\UserBundle\Validator\Constraints as VardiusAssert;

/**
 * Vardius\Bundle\UserBundle\Form\Model\ChangePassword
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ChangePassword
{
    /**
     * @var string
     *
     * @SecurityAssert\UserPassword()
     */
    protected $oldPassword;

    /**
     * @var string
     *
     * @Assert\Length(
     *     min = 8,
     *     max = 4096
     * )
     * @Assert\NotBlank()
     * @VardiusAssert\Password()
     */
    protected $newPassword;

    /**
     * @return string
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * @param string $oldPassword
     */
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;
    }

    /**
     * @return mixed
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * @param mixed $newPassword
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;
    }
}
