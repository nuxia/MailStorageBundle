<?php

namespace Nuxia\MailStorageBundle\Tests\Model;

use Nuxia\MailStorageBundle\Model\MailEntryManager;

class MailEntryManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateMailEntry()
    {
        $className = 'Nuxia\MailStorageBundle\Entity\MailEntry';
        $mailEntryManager = new MailEntryManager();
        $mailEntryManager->setClassName($className);

        $this->assertInstanceOf('Nuxia\MailStorageBundle\Entity\MailEntry', $mailEntryManager->createMailEntry());
    }

    public function testSetClassName()
    {
        $className = 'Nuxia\MailStorageBundle\Entity\MailEntry';

        $mailEntryManager = new MailEntryManager();
        $mailEntryManager->setClassName($className);
        $this->assertAttributeEquals($className, 'className', $mailEntryManager);
    }

    public function testGetClassName()
    {
        $className = 'Nuxia\MailStorageBundle\Entity\MailEntry';
        $reflector = new \ReflectionClass('Nuxia\MailStorageBundle\Model\MailEntryManager');
        $property = $reflector->getProperty('className');
        $property->setAccessible(true);

        $mailEntryManager = new MailEntryManager($className);
        $property->setValue($mailEntryManager, $className);
        $this->assertEquals($className, $mailEntryManager->getClassName());
    }
}
