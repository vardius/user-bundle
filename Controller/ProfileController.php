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

/**
 * Vardius\Bundle\UserBundle\Controller\ProfileController
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class ProfileController extends Controller
{
    /**
     * @return array
     * @Template()
     */
    public function showAction()
    {
        return [
            'user' => $this->getUser(),
        ];
    }

    /**
     * @param Request $request
     * @return array
     * @Template()
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $formType = $this->container->getParameter('vardius_user.user_edit_form') ?: 'vardius_edit_user';

        $form = $this->createForm($formType, $user);

        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirect($this->generateUrl('profile_show'));
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
