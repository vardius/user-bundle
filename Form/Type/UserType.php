<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Vardius\Bundle\UserBundle\Manager\UserManagerInterface;

/**
 * Vardius\Bundle\UserBundle\Form\Type\UserType
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class UserType extends AbstractType
{
    /** @var  boolean */
    protected $addUsername;
    /** @var  UserManagerInterface */
    protected $userManager;

    /**
     * @param UserManagerInterface $userManager
     */
    function __construct($userManager)
    {
        $this->userManager = $userManager;
        $this->addUsername = $this->userManager->addUsername();
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($this->addUsername) {
            $builder->add('username', null, [
                'label' => 'user.form.username',
            ]);
        }

        $builder
            ->add('email', 'email', [
                'label' => 'user.form.email',
            ])
            ->add('plainPassword', 'repeated', [
                'first_options' => array('label' => 'user.form.first_name'),
                'second_options' => array('label' => 'user.form.second_name'),
                'type' => 'password',
            ]);
    }

    /**
     * @inheritDoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => $this->userManager->getUserCLass(),
            'validation_groups' => function () {
                return ($this->addUsername ? ['Default', 'username'] : ['Default']);
            }
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'vardius_user';
    }

}
