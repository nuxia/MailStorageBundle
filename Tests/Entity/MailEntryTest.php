<?php

namespace Nuxia\MailStorageBundle\Tests\Entity;

use Nuxia\MailStorageBundle\Entity\AbstractMailEntry;

class MailEntryTest extends \PHPUnit_Framework_TestCase
{
    public function testSetStatus()
    {
        $status = DummyMailEntry::STATUS_SENT;

        $mailEntry = new DummyMailEntry();
        $mailEntry->setStatus($status);
        $this->assertAttributeEquals($status, 'status', $mailEntry);
    }

    public function testGetStatus()
    {
        $status = DummyMailEntry::STATUS_SENT;
        $reflector = new \ReflectionClass('Nuxia\MailStorageBundle\Entity\DummyMailEntry');
        $property = $reflector->getProperty('status');
        $property->setAccessible(true);

        $mailEntry = new DummyMailEntry();
        $property->setValue($mailEntry, $status);
        $this->assertEquals($status, $mailEntry->getStatus());
    }

    public function testSetSentAt()
    {
        $sentAt = new \Datetime();

        $mailEntry = new DummyMailEntry();
        $mailEntry->setSentAt($sentAt);
        $this->assertAttributeEquals($sentAt, 'sentAt', $mailEntry);
    }

    public function testGetSendAt()
    {
        $sentAt = new \Datetime();
        $reflector = new \ReflectionClass('Nuxia\MailStorageBundle\Entity\DummyMailEntry');
        $property = $reflector->getProperty('sentAt');
        $property->setAccessible(true);

        $mailEntry = new DummyMailEntry();
        $property->setValue($mailEntry, $sentAt);
        $this->assertEquals($sentAt, $mailEntry->getSentAt());
    }

    /**
     * @return \Swift_Message
     */
    private function createSwiftMessage()
    {
        $message = new \Swift_Message();
        $message->generateId();
        $message->setSubject('subject');
        $message->setBody('html-body', 'text/html');
        $message->setTo('to@email.com');
        $message->setFrom('from@email.com');

        return $message;
    }

    public function testFromSwiftMessageDefaultValues()
    {
        $mailEntry = new DummyMailEntry();
        $message = $this->createSwiftMessage();
        $mailEntry->fromSwiftMessage($message, 'fr');

        $this->assertEquals($mailEntry->getId(), $message->getId());
        $this->assertEquals($mailEntry->getSubject(), $message->getSubject());
        $this->assertEquals($mailEntry->getContent(), $message->getBody());
        $this->assertEquals($mailEntry->getContentText(), $message->getBody());
        $this->assertNotEmpty($mailEntry->getTo());
        $this->assertNotEmpty($mailEntry->getFrom());
        $this->assertEquals($mailEntry->getStatus(), DummyMailEntry::STATUS_PENDING);
        $this->assertEquals($mailEntry->getLanguage(), 'fr');
        $this->assertEquals($mailEntry->getHeader(), $message->getHeaders()->toString());

        $this->assertNull($mailEntry->getObject());
        $this->assertNull($mailEntry->getObjectId());
        $this->assertEmpty($mailEntry->getBcc());
        $this->assertEmpty($mailEntry->getCc());
    }

    public function testFromSwiftMessageLanguage()
    {
        $mailEntry = new DummyMailEntry();
        $message = $this->createSwiftMessage();
        $message->getHeaders()->addTextHeader('Content-language', 'en');
        $mailEntry->fromSwiftMessage($message, 'fr');

        $this->assertEquals($mailEntry->getLanguage(), 'en');
    }

    public function testFromSwiftMessageContentText()
    {
        $mailEntry = new DummyMailEntry();
        $message = $this->createSwiftMessage();
        $message->addPart('plain-text', 'text/plain');
        $mailEntry->fromSwiftMessage($message, 'fr');

        $this->assertEquals($mailEntry->getContentText(), 'plain-text');
    }

    public function testFromSwiftMessageHeaders()
    {
        $mailEntry = new DummyMailEntry();
        $message = $this->createSwiftMessage();
        $message->getHeaders()->addTextHeader('Content-language', 'en');
        $message->getHeaders()->addTextHeader('X-MailStorage-Object', 'object');
        $message->getHeaders()->addTextHeader('X-MailStorage-ObjectId', 1);
        $mailEntry->fromSwiftMessage($message, 'fr');

        $this->assertEquals($mailEntry->getLanguage(), 'en');
        $this->assertEquals($mailEntry->getObject(), 'object');
        $this->assertEquals($mailEntry->getObjectId(), 1);
    }

    public function testExtraAddresses()
    {
        $mailEntry = new DummyMailEntry();
        $message = $this->createSwiftMessage();
        $message->setCc('cc@email.com');
        $message->setBcc('bcc@email.com');
        $mailEntry->fromSwiftMessage($message, 'fr');

        $this->assertNotEmpty($mailEntry->getCc());
        $this->assertNotEmpty($mailEntry->getBcc());
    }

}

class DummyMailEntry extends AbstractMailEntry {
}
