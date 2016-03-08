<?php

namespace Nuxia\MailStorageBundle\Storage;

use Nuxia\MailStorageBundle\Entity\AbstractMailEntry;

interface StorageManagerInterface
{
    /**
     * @return AbstractMailEntry
     */
    public function createMailEntry();

    /**
     * @param AbstractMailEntry $mailEntry
     * @param array             $options
     *
     * @return AbstractMailEntry
     */
    public function store(AbstractMailEntry $mailEntry, array $options = array());
}
