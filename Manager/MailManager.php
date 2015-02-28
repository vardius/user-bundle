<?php
/**
 * This file is part of the vardius/user-bundle package.
 *
 * Created by Rafał Lorenz <vardius@gmail.com>.
 */

namespace Vardius\Bundle\UserBundle\Manager;

use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Vardius\Bundle\UserBundle\Manager\MailManager
 *
 * @author Rafał Lorenz <vardius@gmail.com>
 */
class MailManager
{
    /** @var \Swift_Mailer */
    protected $mailer;
    /** @var  string */
    protected $from;
    /** @var  RequestStack */
    protected $requestStack;

    /**
     * @param \Swift_Mailer $mailer
     * @param RequestStack $requestStack
     * @param $from
     */
    function __construct(\Swift_Mailer $mailer, RequestStack $requestStack, $from)
    {
        $this->mailer = $mailer;
        $this->requestStack = $requestStack;
        $this->from = $from;
    }

    /**
     * @param $subject
     * @param $to
     * @param $body
     */
    public function sendEmail($subject, $to, $body)
    {
        $message = $this->mailer
            ->createMessage()
            ->setSubject($subject)
            ->setFrom($this->getFrom())
            ->setTo($to)
            ->setBody($body, 'text/html');

        $this->mailer->send($message);
    }

    /**
     * @return string
     */
    protected function getFrom()
    {
        return ($this->from !== null ?: $this->requestStack->getMasterRequest()->getHost());
    }
}
