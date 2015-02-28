<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vardius\Bundle\UserBundle\Form\Model\ChangePassword;

/**
 * Vardius\Bundle\UserBundle\Controller\UserController
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ChangePasswordController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @Template()
     */
    public function changePasswordAction(Request $request)
    {
        $form = $this->createForm('vardius_change_password', new ChangePassword());

        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $newPassword = $form['newPassword']->getData();
                $user = $this->getUser();

                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user, $newPassword);
                $user->setPassword($encoded);

                $em->persist($user);
                $em->flush();

                $request->getSession()->getFlashBag()->add(
                    'success',
                    'change_password.success'
                );

                return $this->redirect($this->generateUrl('profile_show'));
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
