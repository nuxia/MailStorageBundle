<?php

namespace Nuxia\MailStorageBundle\Storage;

use Nuxia\MailStorageBundle\Model\MailEntryManagerInterface;

abstract class AbstractStorageManager implements StorageManagerInterface
{
    /**
     * @var MailEntryManagerInterface
     */
    protected $mailEntryManager;

    /**
     * @param MailEntryManagerInterface $mailEntryManager
     */
    public function __construct(MailEntryManagerInterface $mailEntryManager)
    {
        $this->mailEntryManager = $mailEntryManager;
    }
}
