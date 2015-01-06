<?php

namespace Nuxia\MailStorageBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Nuxia\MailStorageBundle\Entity\MailEntry;

class MailEntryManager
{
    /**
     * @param ObjectManager
     */
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }
}
 