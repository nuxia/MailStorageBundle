<?php

namespace Nuxia\MailStorageBundle\Storage;
;
use Nuxia\MailStorageBundle\Entity\MailEntry;

interface StorageManagerInterface
{
    /**
     * @return MailEntry
     */
    public function createMailEntry();

    /**
     * @param  MailEntry $mailEntry
     * @param  array     $options
     *
     * @return MailEntry
     */
    public function store(MailEntry $mailEntry, array $options = array());

    /**
     * @param  string $id
     *
     * @return MailEntry
     */
    public function find($id);
}
 