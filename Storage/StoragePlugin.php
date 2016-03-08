<?php

namespace Nuxia\MailStorageBundle\Storage;

use Nuxia\MailStorageBundle\Entity\AbstractMailEntry;

class StoragePlugin implements \Swift_Events_SendListener
{
    /**
     * @var StorageManagerInterface
     */
    private $storageManager;

    /**
     * @var AbstractMailEntry
     */
    private $mailEntry;

    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @param StorageManagerInterface $storageManager
     * @param string                  $defaultLocale
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
            $this->mailEntry = $this->storageManager->createMailEntry();
            $this->mailEntry->fromSwiftMessage($evt->getMessage(), $this->defaultLocale);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function sendPerformed(\Swift_Events_SendEvent $evt)
    {
        if (!$this->isSpoolTransport($evt->getTransport())) {
            $this->mailEntry->setStatus(AbstractMailEntry::STATUS_SENT);
            $this->mailEntry->setSentAt(new \Datetime());
            $this->storageManager->store($this->mailEntry);
        }
    }

    /**
     * @param \Swift_Transport $transport
     *
     * @return bool
     */
    private function isSpoolTransport(\Swift_Transport $transport)
    {
        return $transport instanceof \Swift_Transport_SpoolTransport;
    }
}
