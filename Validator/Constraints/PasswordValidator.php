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
        if (!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $value, $matches)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
            $this->context->buildViolation($constraint->message2)
                ->setParameter('%string%', $value)
                ->addViolation();
            $this->context->buildViolation($constraint->message3)
                ->setParameter('%string%', $value)
                ->addViolation();
            $this->context->buildViolation($constraint->message4)
                ->setParameter('%string%', $value)
                ->addViolation();
            $this->context->buildViolation($constraint->message5)
                ->setParameter('%string%', $value)
                ->addViolation();
            $this->context->buildViolation($constraint->message6)
                ->setParameter('%string%', $value)
                ->addViolation();
            $this->context->buildViolation($constraint->message7)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
