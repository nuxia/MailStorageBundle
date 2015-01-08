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
        $this->objectManager->persist($mailEntry);
        if (!isset($options['and_flush']) || true === $options['and_flush']) {
            $this->objectManager->flush();
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