<?php

namespace Nuxia\MailStorageBundle\Entity;

use Doctrine\Common\Util\Inflector;
use Nuxia\MailStorageBundle\SwiftMessageUtils;

abstract class AbstractMailEntry
{
    /**
     * @var string
     */
    const REFERENCE_DEFAULT = 'system';

    /**
     * @var string
     */
    const STATUS_PENDING = 'pending';

    /**
     * @var string
     */
    const STATUS_SENT = 'sent';

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $object;

    /**
     * @var integer
     */
    protected $objectId;

    /**
     * @var string
     */
    protected $reference;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $header;

    /**
     * @var array
     */
    protected $from;

    /**
     * @var array
     */
    protected $to;

    /**
     * @var array
     */
    protected $cc;

    /**
     * @var array
     */
    protected $bcc;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $contentText;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $sentAt;

    public function __construct()
    {
        $this->createdAt = new \Datetime();
        $this->reference = self::REFERENCE_DEFAULT;
        $this->status = self::STATUS_PENDING;
    }

    /**
     * @param string $id
     *
     * @return AbstractMailEntry
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
     * @param string $object
     *
     * @return AbstractMailEntry
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
     * @param integer $objectId
     *
     * @return AbstractMailEntry
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
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $language
     *
     * @return AbstractMailEntry
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
     * @param string $header
     *
     * @return AbstractMailEntry
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
     * @param array $from
     *
     * @return AbstractMailEntry
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
     * @param array $to
     *
     * @return AbstractMailEntry
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
     * @param array|null $cc
     *
     * @return AbstractMailEntry
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
     * @param array|null $bcc
     *
     * @return AbstractMailEntry
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
     * @param string $subject
     *
     * @return AbstractMailEntry
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
     * @param string $content
     *
     * @return AbstractMailEntry
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
     * @param string $contentText
     *
     * @return AbstractMailEntry
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
     * @param string $status
     *
     * @return AbstractMailEntry
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
     * @param \DateTime $createdAt
     *
     * @return AbstractMailEntry
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
     * @param \DateTime $sentAt
     *
     * @return AbstractMailEntry
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
     * @param \Swift_Message $message
     * @param string         $defaultLanguage
     *
     * @return AbstractMailEntry
     *
     * @throws \RuntimeException
     */
    public function fromSwiftMessage(\Swift_Message $message, $defaultLanguage)
    {
        $this->setId($message->getId());
        $this->setSubject($message->getSubject());
        $this->setContent($message->getBody());
        $this->setContentText(SwiftMessageUtils::getPart($message, 'text/plain'));

        if (null === $this->getContentText()) {
            $this->setContentText($this->getContent());
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

        $headerSetPattern = strtolower('X-MailStorage-');

        foreach (preg_grep('/^' . $headerSetPattern . '.*$/', $headerSet->listAll()) as $headerKey) {
            $method = 'set'. Inflector::camelize(substr($headerKey, strlen($headerSetPattern)));
            if (is_callable(array($this, $method))) {
                $this->$method($headerSet->get($headerKey)->getFieldBody());
            }
            $headerSet->remove($headerKey);
        }
        $this->setHeader($message->getHeaders()->toString());

        return $this;
    }
}
