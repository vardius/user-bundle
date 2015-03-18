<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Routing\Exception\InvalidParameterException;

/**
 * Vardius\Bundle\UserBundle\DependencyInjection\VardiusUserExtension
 *
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class VardiusUserExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('vardius_user.user_class', $config['user_class']);
        $container->setParameter('vardius_user.user_edit_form', $config['user_edit_form']);
        $container->setParameter('vardius_user.user_form', $config['user_form']);
        $container->setParameter('vardius_user.username', $config['username']);

        $mailFrom = $config['mail_from'];
        if(!\Swift_Validate::email($mailFrom)){
            throw new InvalidParameterException('vardius_user.mail_from is not valid email address!');
        }

        $container->setParameter('vardius_user.mail_from', $mailFrom);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
}
