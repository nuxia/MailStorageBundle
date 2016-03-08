<?php

namespace Nuxia\MailStorageBundle\Model;

use Nuxia\MailStorageBundle\Entity\AbstractMailEntry;

interface MailEntryManagerInterface
{
    /**
     * @return AbstractMailEntry
     */
    public function createMailEntry();

    /**
     * @return string
     */
    public function getClassName();
}
