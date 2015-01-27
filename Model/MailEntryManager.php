<?php

namespace Nuxia\MailStorageBundle\Model;

class MailEntryManager implements MailEntryManagerInterface
{
    /**
     * @var string
     */
    protected $className;

    /**
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * {@inheritDoc}
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * {@inheritDoc}
     */
    public function createMailEntry()
    {
        $class = new $this->className();
        return new $class();
    }
}
