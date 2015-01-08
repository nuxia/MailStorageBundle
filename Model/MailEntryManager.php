<?php

namespace Nuxia\MailStorageBundle\Model;

class MailEntryManager implements MailEntryManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function createMailEntry()
    {
        $class = $this->getClassname();
        return new $class();
    }

    /**
     * {@inheritDoc}
     */
    public function getClassName()
    {
        return 'Nuxia\MailStorageBundle\Entity\MailEntry';
    }
}
