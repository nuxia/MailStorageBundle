<?php

namespace Nuxia\MailStorageBundle\Model;

use Nuxia\MailStorageBundle\Entity\MailEntry;

class MailEntryManager implements MailEntryManagerInterface
{
    /**
     * @return string
     */
    protected function getClassName()
    {
        return 'Nuxia\MailStorageBundle\Entity\MailStorage';
    }

    /**
     * @return MailEntry
     */
    public function createMailEntry()
    {
        $class = $this->getClassname();
        $mailEntry = new $class();
        return $mailEntry;
    }
}
 