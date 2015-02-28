<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Vardius\Bundle\UserBundle\Validator\Constraints\Password
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 *
 * @Annotation
 */
class Password extends Constraint
{
    public $message = 'user.email.message';
    public $message2 = 'user.email.message2';
    public $message3 = 'user.email.message3';
    public $message4 = 'user.email.message4';
    public $message5 = 'user.email.message5';
    public $message6 = 'user.email.message6';
    public $message7 = 'user.email.message7';
}
