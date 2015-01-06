<?php

namespace Nuxia\MailStorageBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Nuxia\MailStorageBundle\Entity\MailEntry;
use Nuxia\MailStorageBundle\Model\MailEntryManager as BaseMailEntryManager;

class MailEntryManager extends BaseMailEntryManager
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
    public function getRepository()
    {
        return $this->objectManager->getRepository($this->getClassName());
    }

    /**
     * @param MailEntry $mailEntry
     * @param bool      $andFlush
     */
    public function persist(MailEntry $mailEntry, $andFlush = true)
    {
        $this->objectManager->persist($mailEntry);
        if (true === $andFlush) {
            $this->objectManager->flush();
        }
    }
} 