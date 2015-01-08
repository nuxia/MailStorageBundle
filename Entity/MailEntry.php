<?php

namespace Nuxia\MailStorageBundle\Entity;

use Nuxia\MailStorageBundle\SwiftMessageUtils;

class MailEntry
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $object;

    /**
     * @var integer
     */
    private $objectId;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $header;

    /**
     * @var array
     */
    private $from;

    /**
     * @var array
     */
    private $to;

    /**
     * @var array
     */
    private $cc;

    /**
     * @var array
     */
    private $bcc;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $contentText;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $sentAt;

    public function __construct()
    {
        $this->createdAt = new \Datetime();
        $this->status = 'pending';
    }

    /**
     * @param  string $id
     *
     * @return MailEntry
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  string $object
     *
     * @return MailEntry
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param  integer $objectId
     *
     * @return MailEntry
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * @param  string $language
     *
     * @return MailEntry
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /*
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param  string $header
     *
     * @return MailEntry
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param  array $from
     *
     * @return MailEntry
     */
    public function setFrom(array $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return array
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param  array $to
     *
     * @return MailEntry
     */
    public function setTo(array $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param  array|null $cc
     *
     * @return MailEntry
     */
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * @return array
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param  array|null $bcc
     *
     * @return MailEntry
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;

        return $this;
    }

    /**
     * @return array
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param  string $subject
     *
     * @return MailEntry
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param  string $content
     *
     * @return MailEntry
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param  string $contentText
     *
     * @return MailEntry
     */
    public function setContentText($contentText)
    {
        $this->contentText = $contentText;

        return $this;
    }

    /**
     * @return string
     */
    public function getContentText()
    {
        return $this->contentText;
    }

    /**
     * @param  string $status
     *
     * @return MailEntry
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param  \DateTime $createdAt
     *
     * @return MailEntry
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param  \DateTime $sentAt
     *
     * @return MailEntry
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * @param  \Swift_Message $message
     * @param  string         $defaultLanguage
     *
     * @return MailEntry
     *
     * @throws \RuntimeException
     */
    public function fromSwiftMessage(\Swift_Message $message, $defaultLanguage)
    {
        $this->setId($message->getId());
        $this->setSubject($message->getSubject());
        $this->setContent($message->getBody());
        $this->setContentText(SwiftMessageUtils::getPart($message, 'text/plain'));
        if ($this->getContentText() === null) {
            throw new \RuntimeException('The SwiftMessage must have a plain text content part');
        }

        $headerSet = $message->getHeaders();
        if ($message->getHeaders()->has('Content-language')) {
            $this->setLanguage($headerSet->get('Content-language')->getFieldBody());
        } else {
            $this->setLanguage($defaultLanguage);
        }

        foreach (array('cc', 'bcc', 'to', 'from') as $field) {
            $fieldValue = $message->{'get' . ucfirst($field)}();
            if (is_array($fieldValue) && count($fieldValue) > 0) {
                $this->{'set' . ucfirst($field)}(SwiftMessageUtils::addressesToSimpleArray($fieldValue));
            }
        }

        foreach (array('X-MailStorage-Object', 'X-MailStorage-ObjectId') as $headerKey) {
            if ($headerSet->has($headerKey)) {
                $this->{'set' . explode('-', $headerKey)[2]}($headerSet->get($headerKey)->getFieldBody());
                $headerSet->remove($headerKey);
            }
        }
        $this->setHeader($message->getHeaders()->toString());

        return $this;
    }
}
