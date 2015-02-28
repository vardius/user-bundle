<?php
/**
 * This file is part of the zamocno package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Vardius\Bundle\UserBundle\Form\Type\ChangePasswordType
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', 'password', [
                'label' => 'change_password.form.old_password',
            ])
            ->add('newPassword', 'repeated', [
                'label' => 'change_password.form.new_password',
                'type' => 'password',
                'required' => true,
            ])
            ->add('change_password', 'submit', [
                'label' => 'change_password.form.button',
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vardius\Bundle\UserBundle\Form\Model\ChangePassword',
        ));
    }

    public function getName()
    {
        return 'vardius_change_password';
    }
}
