Vardius - User Bundle
======================================

Installation
----------------
1. Download using composer
2. Enable the VardiusUserBundle
3. Create user class

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
