<?php

namespace Nuxia\MailStorageBundle\Model;

use Nuxia\MailStorageBundle\Entity\MailEntry;

interface MailEntryManagerInterface
{
    /**
     * @return MailEntry
     */
    public function createMailEntry();
}
