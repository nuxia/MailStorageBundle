<?php

namespace Nuxia\MailStorageBundle\Storage;

use Nuxia\MailStorageBundle\Doctrine\MailEntryManager;

class StoragePlugin implements \Swift_Events_SendListener
{
    /**
     * @var MailEntryManager
     */
    private $mailEntryManager;

    /**
     * @param MailEntryManager $mailEntryManager
     */
    public function __construct(MailEntryManager $mailEntryManager)
    {
        $this->mailEntryManager = $mailEntryManager;
    }

    /**
     * {@inheritDoc}
     */
    public function beforeSendPerformed(\Swift_Events_SendEvent $evt)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function sendPerformed(\Swift_Events_SendEvent $evt)
    {
        $message = $evt->getMessage();

        $mailEntry = $this->$mailEntryManager->createMailEntry();
        $mailEntry->getFrom($message->getFrom());
        $mailEntry->getCc($message->getCc());
        $mailEntry->getBcc($message->getBcc());
        $mailEntry->getFrom($message->getFrom());
        $mailEntry->getFrom($message->getFrom());
        $mailEntry->getHeader($message->getHeaders()->toString());
        $mailEntry->setContent($message->getBody());
        $mailEntry->setSubject($message->getSubject());
        //@TODO
        $mailEntry->setLanguage('en');
        $mailEntry->setContentText('temp');

        $mailEntry->setStatus('sent');
        $mailEntry->setSentAt(new \DateTime());
        $this->mailEntryManager->persist($mailEntry);
    }
}