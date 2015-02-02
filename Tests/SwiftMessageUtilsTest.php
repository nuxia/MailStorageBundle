<?php

namespace Nuxia\MailStorageBundle;

class SwiftMessageUtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testAddressesToSimpleArray()
    {
        $addresses = array('test@test.fr' => 'Test Name');
        $this->assertEquals(array('Test Name<test@test.fr>'), SwiftMessageUtils::addressesToSimpleArray($addresses));

        $addresses = array('test@test.fr');
        $this->assertEquals(array('test@test.fr'), SwiftMessageUtils::addressesToSimpleArray($addresses));

        $addresses = array('test@test.fr' => null);
        $this->assertEquals(array('test@test.fr'), SwiftMessageUtils::addressesToSimpleArray($addresses));

        $addresses = array('test@test.fr' => 'Test Name', 'test2@test.fr');
        $this->assertEquals(array('Test Name<test@test.fr>','test2@test.fr'), SwiftMessageUtils::addressesToSimpleArray($addresses));

        $addresses = array('test@test.fr' => 'Test Name', 'test2@test.fr' => null);
        $this->assertEquals(array('Test Name<test@test.fr>','test2@test.fr'), SwiftMessageUtils::addressesToSimpleArray($addresses));

        $addresses = array('test@test.fr', 'test2@test.fr' => null);
        $this->assertEquals(array('test@test.fr','test2@test.fr'), SwiftMessageUtils::addressesToSimpleArray($addresses));
    }

    public function testGetPart()
    {
        $message = new \Swift_Message();
        $message->addPart('Plain text', 'text/plain');

        $this->assertEquals('Plain text', SwiftMessageUtils::getPart($message, 'text/plain'));
        $this->assertNull(SwiftMessageUtils::getPart($message, 'unknown'));
    }
}
