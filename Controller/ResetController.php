<?php
/**
 * This file is part of the zamocno package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Vardius\Bundle\UserBundle\Form\Model\ResetPassword;

/**
 * Vardius\Bundle\UserBundle\Controller\ResetController
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ResetController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @Template()
     */
    public function resetPasswordAction(Request $request)
    {
        $form = $this->createForm('vardius_reset_password', new ResetPassword());

        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isSubmitted() && $form->isValid()) {

                $email = $form['email']->getData();
                $user = $this->get('vardius_user.user_manager')->findUserBy([
                    'email' => $email,
                ]);

                if (!$user) {
                    $error = new FormError('reset_password.error');
                    $form->get('email')->addError($error);
                } else {
                    $password = substr(md5(uniqid()), 0, 12);

                    $mailManager = $this->get('vardius_user.mail_manager');
                    $mailManager->sendEmail('New Password', $user->getEmail(), $this->renderView(
                        '@VardiusUser/Reset/newPassword.html.twig', [
                        'password' => $password
                    ]));

                    $encoder = $this->container->get('security.password_encoder');
                    $encoded = $encoder->encodePassword($user, $password);
                    $user->setPassword($encoded);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();

                    $request->getSession()->getFlashBag()->add(
                        'notice',
                        'reset_password.success'
                    );

                    return $this->redirect($this->generateUrl('login_route'));
                }
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
