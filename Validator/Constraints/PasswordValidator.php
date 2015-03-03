<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Vardius\Bundle\UserBundle\Validator\Constraints\PasswordValidator
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class PasswordValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^(?=.*\d)(?=.*[a-zA-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
