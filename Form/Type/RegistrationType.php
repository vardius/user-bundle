<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Vardius\Bundle\UserBundle\Form\Type\RegistrationType
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class RegistrationType extends AbstractType
{
    /** @var  string */
    protected $userForm;

    function __construct($userForm)
    {
        $this->userForm = $userForm ?: 'vardius_user';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', $this->userForm, [
                'label' => false,
            ])
            ->add('terms', 'checkbox', [
                'property_path' => 'termsAccepted',
                'label' => 'registration.form.terms',
            ])
            ->add('register', 'submit', [
                'label' => 'registration.form.button',
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Vardius\Bundle\UserBundle\Form\Model\Registration',
            'cascade_validation' => true,
        ]);
    }

    public function getName()
    {
        return 'vardius_registration';
    }
}
