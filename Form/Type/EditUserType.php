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

/**
 * Vardius\Bundle\UserBundle\Form\Type\EditUserType
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class EditUserType extends AbstractType
{
    /** @var  boolean */
    protected $addUsername;

    /**
     * @param boolean $addUsername
     */
    function __construct($addUsername)
    {
        $this->addUsername = $addUsername;
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($this->addUsername) {
            $builder->add('username');
        }

        $builder
            ->add('email', 'email', [
                'label' => 'edit_user.form.email',
            ])
            ->add('edit', 'submit', [
                'label' => 'edit_user.form.button',
            ]);
    }

    /**
     * @inheritDoc
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Vardius\Bundle\UserBundle\Entity\User',
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
        return 'vardius_edit_user';
    }
}
