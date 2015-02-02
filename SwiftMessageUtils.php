<?php

namespace Nuxia\MailStorageBundle;

class SwiftMessageUtils
{
    private function __construct()
    {
        //Avoid new on class
    }

    /**
     * @param  array $address
     *
     * @return array
     */
    public static function addressesToSimpleArray(array $address)
    {
        $parse = array();
        foreach ($address as $key => $value) {
            if (is_numeric($key)) {
                $parse[] = $value;
            } elseif ($value === null) {
                $parse[] = $key;
            } else {
                $parse[] = $value . '<' . $key . '>';
            }
        }
        return $parse;
    }

    /**
     * @param  \Swift_Message $message
     * @param  string         $contentType
     *
     * @return string|null
     */
    public static function getPart(\Swift_Message $message, $contentType)
    {
        foreach ($message->getChildren() as $child) {
            if ($child->getContentType() === $contentType) {
                return $child->getBody();
            }
        }

        return null;
    }
}
