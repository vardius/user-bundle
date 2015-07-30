Vardius - User Bundle
======================================

User Bundle provides simple doctrine user

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/6fa73f37-04c8-493c-b690-55c85de3f6da/big.png)](https://insight.sensiolabs.com/projects/6fa73f37-04c8-493c-b690-55c85de3f6da)

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
3. Create user class
4. Configure the VardiusUserBundle
5. Overriding a Form Type

### 1. Download using composer

Install the package through composer:

``` bash
    $ php composer.phar require vardius/user-bundle:*
```

### 2. Enable the VardiusUserBundle
Enable the bundle in the kernel:

``` php
    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Vardius\Bundle\UserBundle\VardiusUserBundle(),
        );
            
        // ...
    }
```

### 3. Create user class
Create user class and extends Vardius\Bundle\UserBundle\Entity\User  as a BaseUser

``` php
// src/Acme/UserBundle/Entity/User.php
    <?php
    
    use Vardius\Bundle\UserBundle\Entity\User as BaseUser;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;
    
    /**
     * @ORM\Table(name="acne_users")
     * @ORM\Entity(repositoryClass="Vardius\Bundle\UserBundle\Entity\UserRepository")
     */
    class User extends BaseUser
    {
        /**
         * @ORM\Column(type="string", length=255)
         *
         * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
         * @Assert\Length(
         *     min=3,
         *     max="255",
         *     minMessage="The name is too short.",
         *     maxMessage="The name is too long.",
         *     groups={"Registration", "Profile"}
         * )
         */
        protected $name;
    
        // ...
    }
```

next register your class in config.yml
and set an email address for password reset,
this email will be show in message user gets as a sender.

``` yaml
    #app/config/config.yml
    
    vardius_user:
        user_class: AcmeUserBundle:User
        mail_from: example@email.com
```

### 4. Configure the VardiusUserBundle

If you want to enable username
config.yml

``` yaml
    #app/config/config.yml
    
    vardius_user:
        username: true #default false
        email_from: some@email.com #default hostname
```
        
routing.yml

``` yaml
    #app/config/routing.yml
    
    vardius_user:
        resource: "@VardiusUserBundle/Resources/config/routing.yml"
        prefix:   /
```
        
or enable some routes only:

``` yaml
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
```
        
security.yml

``` yaml
    #app/config/security.yml
    
    encoders:
        Vardius\Bundle\UserBundle\Entity\UserInterface:
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
                invalidate_session: true
            remember_me:
                key:      "%secret%"
                lifetime: 31536000 # 365 days in seconds
                path:     /
                domain:   ~ # Defaults to the current domain from $_SERVER

    access_control:
        - { path: ^/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/register, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/password-reset, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/, roles: ROLE_USER }
```

### 5. Overriding a Form Type
If you want user to put his name when register override user type form

``` php
    // src/Acme/UserBundle/Form/Type/UserType.php
    <?php
    
    namespace Acme\UserBundle\Form\Type;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    
    class UserType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            // add your custom field
            $builder->add('name');
        }
    
        public function getParent()
        {
            return 'vardius_user';
        }
    
        public function getName()
        {
            return 'acme_user';
        }
    }
```

register your form as a service

``` xml
    <service id="acme_user.user.form.type" class="Acme\UserBundle\Form\Type\UserType">
        <tag name="form.type" alias="acme_user" />
    </service>
```

next register your class in config.yml

``` yaml
    #app/config/cinfig.yml
    
    vardius_user:
        user_form: acme_user
```

to override user edit form provide

``` php
    // src/Acme/UserBundle/Form/Type/UserEditType.php
    <?php
    
    namespace Acme\UserBundle\Form\Type;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    
    class UserEditType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            // add your custom field
            $builder->add('name');
        }
    
        public function getParent()
        {
            return 'vardius_edit_user';
        }
    
        public function getName()
        {
            return 'acme_user_edit';
        }
    }
```

register your form as a service

``` xml
    <service id="acme_user.user_edit.form.type" class="Acme\UserBundle\Form\Type\UserEditType">
        <tag name="form.type" alias="acme_user_edit" />
    </service>
```

``` yaml
    #app/config/cinfig.yml
    
    vardius_user:
        user_edit_form: acme_edit_user
```

There is build in terms action,
if you want user to be able read terms, you can for example link form label to it:

``` twig
    <a href="{{ path('account_register_terms') }}">{{ form_label(form.terms, null, {'label_attr': {'class': 'col-md-3 control-label'}}) }}</a>
```

to overrider terms, override its view.

``` twig
    {% extends '@VardiusUser/Registration/terms.html.twig' %}
```

RELEASE NOTES
==================================================
**0.1.0**

- First public release of user-bundle

**0.2.0**

- Major bug fix and updates
