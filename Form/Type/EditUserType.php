<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Vardius\Bundle\UserBundle\Form\Type\EditUserType
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class EditUserType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->remove('plainPassword')
            ->add('edit', 'submit', [
                'label' => 'edit_user.form.button',
            ]);
    }

    public function getParent()
    {
        return 'vardius_user';
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'vardius_edit_user';
    }
}
