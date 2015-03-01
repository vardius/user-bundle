<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Twig;

/**
 * Vardius\Bundle\UserBundle\Twig\GravatarExtension
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class GravatarExtension
{
    /**
     * Returns a list of filters.
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('gravatar_url', array($this, 'getGravatarUrl')),
        );
    }

    public function getGravatarUrl($email, $size = null)
    {
        $url = 'https://secure.gravatar.com/avatar/' . md5($email) . '?d=mm';

        if ($size) {
            $url .= '&s=' . $size;
        }

        return $url;
    }

    public function getName()
    {
        return 'gravatar_url';
    }

}
