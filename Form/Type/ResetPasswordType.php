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
 * Vardius\Bundle\UserBundle\Form\Type\ResetPasswordType
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', [
                'label' => 'reset_password.form.email',
            ])
            ->add('password', 'password', [
                'label' => 'reset_password.form.password',
            ])
            ->add('reset_password', 'submit', [
                'label' => 'reset_password.form.button',
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vardius\Bundle\UserBundle\Form\Model\ResetPassword',
        ));
    }

    public function getName()
    {
        return 'vardius_reset_password';
    }
}