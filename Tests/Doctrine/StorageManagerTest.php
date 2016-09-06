<?php

namespace Nuxia\MailStorageBundle\Tests\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Nuxia\MailStorageBundle\Doctrine\StorageManager;
use Nuxia\MailStorageBundle\Entity\AbstractMailEntry;

class StorageManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StorageManager
     */
    protected $storageManager;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $objectManager;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $mailEntryManager;

    /**
     * @var string
     */
    protected $className = 'Nuxia\MailStorageBundle\Entity\AbstractMailEntry';

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        $this->objectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');

        $this->mailEntryManager = $this->getMock('Nuxia\MailStorageBundle\Model\MailEntryManagerInterface');
        $this->mailEntryManager->expects($this->any())
            ->method('getClassName')
            ->will($this->returnValue($this->className));

        $this->storageManager = new StorageManager($this->mailEntryManager);
        $this->storageManager->setDoctrineRegistry($this->objectManager);
    }

    public function testCreateMailEntry()
    {
        $this->mailEntryManager->expects($this->once())
            ->method('createMailEntry')
            ->willReturn($this->isInstanceOf($this->className));

        $this->storageManager->createMailEntry();
    }

    public function testGetRepository()
    {
        $this->objectManager->expects($this->once())
            ->method('getRepository')
            ->with($this->className);

        $this->storageManager->getRepository();
    }

    public function testStore()
    {
        $mailEntry = new DummyMailEntry();

        $this->objectManager->expects($this->once())
            ->method('persist')
            ->with($mailEntry);
        $this->objectManager->expects($this->once())
            ->method('flush');

        $this->storageManager->store($mailEntry);
    }
}

class DummyMailEntry extends AbstractMailEntry {
}
