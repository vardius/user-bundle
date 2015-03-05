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
use Vardius\Bundle\UserBundle\Event\RegisterEvent;
use Vardius\Bundle\UserBundle\Event\RegisterEvents;
use Vardius\Bundle\UserBundle\Form\Model\Registration;

/**
 * Vardius\Bundle\UserBundle\Controller\UserController
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @Template()
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm('vardius_registration', new Registration());

        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $registration = $form->getData();
                $user = $registration->getUser();

                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($encoded);

                if ($user->getUsername() === null) {
                    $user->setUsername($user->getEmail());
                }

                $user->eraseCredentials();

                $registerEvent = new RegisterEvent($user);
                $this->get('event_dispatcher')->dispatch(RegisterEvents::REGISTER_PRE_PERSIST, $registerEvent);

                $em->persist($user);
                $em->flush();

                $this->get('event_dispatcher')->dispatch(RegisterEvents::REGISTER_POST_PERSIST, $registerEvent);

                return $this->redirect($this->generateUrl('login_route'));
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @return array
     * @Template()
     */
    public function termsAction()
    {
        return [];
    }
}
