<?php

namespace Nuxia\MailStorageBundle\Doctrine;

use Nuxia\MailStorageBundle\Entity\AbstractMailEntry;
use Nuxia\MailStorageBundle\Storage\AbstractStorageManager;
use Symfony\Bridge\Doctrine\RegistryInterface;

class StorageManager extends AbstractStorageManager
{
    /**
     * @var RegistryInterface $doctrineRegistry
     */
    protected $doctrineRegistry;

    /**
     * @param RegistryInterface $doctrineRegistry
     */
    public function setDoctrineRegistry(RegistryInterface $doctrineRegistry)
    {
        $this->doctrineRegistry = $doctrineRegistry;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository()
    {
        return $this->doctrineRegistry->getRepository($this->mailEntryManager->getClassName());
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
    public function store(AbstractMailEntry $mailEntry, array $options = array())
    {
        $entityManager = $this->doctrineRegistry->getManager();
        $entityManager->persist($mailEntry);
        $entityManager->flush($mailEntry);
    }
}
