<?php

namespace Nuxia\MailStorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MailEntry
 */
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
    public function setFrom($from)
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
    public function setTo($to)
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
     * @param  array $cc
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
     * @param  array $bcc
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
}
