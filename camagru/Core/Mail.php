<?php

namespace Core;
class Mail {

    protected $_from;
    protected $_to;
    protected $_object;
    protected $_message;

    public function __construct($to, $from = "camagru@malallai.fr") {
        $this->_to = $to;
        $this->_from = $from;
    }

    /**
     * @param mixed $object
     */
    public function setObject($object)
    {
        $this->_object = $object;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->_message = $message;
    }

    public function send() {

    }

    public static function newMail() {

    }

}