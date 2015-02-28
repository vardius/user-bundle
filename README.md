Vardius - User Bundle
======================================

User Bundle provides simple doctrine user

This is work in progress, dispatch events in next update.

ABOUT
==================================================
Contributors:

* [Rafał Lorenz](http://rafallorenz.com)

Want to contribute ? Feel free to send pull requests!

Have problems, bugs, feature ideas?
We are using the github [issue tracker](https://github.com/vardius/user-bundle/issues) to manage them.

HOW TO USE
==================================================

Installation
----------------
1. Download using composer
2. Enable the VardiusUserBundle
3. Add roles
4. Configure the VardiusUserBundle


### 1. Download using composer

Install the package through composer:

    php composer.phar require vardius/user-bundle:*

### 2. Enable the VardiusUserBundle
Enable the bundle in the kernel:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Vardius\Bundle\UserBundle\VardiusUserBundle(),
        );
        
        if (...) {
            // ...
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        };
            
        // ...
    }
    
### 3. Add roles
Add roles to database:

    php app/console doctrine:fixtures:load --fixtures=src/Vardius/Bundle/UserBundle/DataFixtures/ORM --append

In a typical setup, you should always return at least 1 role from the getRoles() method. By convention,
a role called ROLE_USER is usually returned. If you fail to return any roles,
it may appear as if your user isn't authenticated at all.
If you want to create user in custom method remember that you have to add `ROLE_USER` when creating user

    $userRole = $em->getRepository('VardiusUserBundle:Role')->findOneByRole('ROLE_USER');
    $user->addRole($userRole);

### 4. Configure the VardiusUserBundle

If you want to enable username
config.yml

    #app/config/cinfig.yml
    
    vardius_user:
        username: true #default false
        email_from: some@email.com #default hostname
        
routing.yml

    #app/config/routing.yml
    
    vardius_user:
        resource: "@VardiusUserBundle/Resources/config/routing.yml"
        prefix:   /
        
or enable some routes only:

    #app/config/routing.yml
    
    login_route:
        path:     /login
        defaults: { _controller: VardiusUserBundle:Security:login }
    
    logout_route:
        path:     /logout
        defaults: { _controller: VardiusUserBundle:Security:logout }
    
    login_check:
        path:     /login_check
        defaults: { _controller: VardiusUserBundle:Security:loginCheck }
        
security.yml

    #app/config/security.yml
    
    encoders:
        Vardius\Bundle\UserBundle\Entity\User:
            algorithm: bcrypt
            cost: 12

    role_hierarchy:
        ROLE_ADMIN:       ROLE_USER
        ROLE_SUPER_ADMIN: [ ROLE_ADMIN, ROLE_ALLOWED_TO_SWITCH ]

    providers:
        vardius:
            id: vardius_user.user_provider

    firewalls:
        admin_area:
            pattern:    ^/
            anonymous: ~
            form_login:
                login_path: login_route
                check_path: login_check
                csrf_provider: form.csrf_provider
            logout:
                path:   logout_route
                target: login_route
            remember_me:
                key:      "%secret%"
                lifetime: 31536000 # 365 days in seconds
                path:     /
                domain:   ~ # Defaults to the current domain from $_SERVER

    access_control:
        - { path: ^/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/logout, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/register, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/password-reset, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/, roles: ROLE_USER }

RELEASE NOTES
==================================================
**0.1.0**

- First public release of user-bundle
