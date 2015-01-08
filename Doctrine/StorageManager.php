<?php

namespace Nuxia\MailStorageBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Nuxia\MailStorageBundle\Entity\MailEntry;
use Nuxia\MailStorageBundle\Storage\AbstractStorageManager;

class StorageManager extends AbstractStorageManager
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @param ObjectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepository()
    {
        return $this->objectManager->getRepository($this->mailEntryManager->getClassName());
    }

    /**
     * {@inheritDoc}
     */
    public function createMailEntry()
    {
        return $this->mailEntryManager->createMailEntry();
    }

    /**
     * {@inheritDoc}
     */
    public function store(MailEntry $mailEntry, array $options = array())
    {
        if ($options['event'] === 'preSend') {
            $this->objectManager->persist($mailEntry);
        } else {
            $this->objectManager->flush($mailEntry);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function find($id)
    {
        return $this->getRepository()->find($id);
    }
}

