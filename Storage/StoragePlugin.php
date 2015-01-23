<?php

namespace Nuxia\MailStorageBundle\Storage;

class StoragePlugin implements \Swift_Events_SendListener
{
    /**
     * @var StorageManagerInterface
     */
    private $storageManager;

    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @param StorageManagerInterface $storageManager
     */
    public function __construct(StorageManagerInterface $storageManager, $defaultLocale)
    {
        $this->storageManager = $storageManager;
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * {@inheritDoc}
     */
    public function beforeSendPerformed(\Swift_Events_SendEvent $evt)
    {
        if (!$this->isSpoolTransport($evt->getTransport())) {
            $mailEntry = $this->storageManager->createMailEntry();
            $mailEntry->fromSwiftMessage($evt->getMessage(), $this->defaultLocale);
            $this->storageManager->store($mailEntry, array('event' => 'beforeSend'));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function sendPerformed(\Swift_Events_SendEvent $evt)
    {
        if (!$this->isSpoolTransport($evt->getTransport())) {
            $mailEntry = $this->storageManager->find($evt->getMessage()->getId());
            $mailEntry->setStatus('sent');
            $mailEntry->setSentAt(new \Datetime());
            $this->storageManager->store($mailEntry, array('event' => 'send'));
        }
    }

    private function isSpoolTransport(\Swift_Transport $transport)
    {
        return $transport instanceof \Swift_Transport_SpoolTransport;
    }
}
