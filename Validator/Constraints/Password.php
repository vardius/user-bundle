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
}
