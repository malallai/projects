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

    public function setObject($object) {
        $this->_object = $object;
    }

    public function setMessage($message) {
        $this->_message = $message;
    }

    public function send() {
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/html; charset=UTF-8";
        $headers[] = "From: Camagru <".$this->_from.">";
        return (mail($this->_to, $this->_object, $this->_message, implode("\r\n", $headers)));
    }

    public static function newMail($to, $object, $mail_content) {
        $mail_content = wordwrap($mail_content, 70, "\r\n");
        ob_start();
        require 'Public/views/mail/Template.php';
        $result = ob_get_clean();
        $mail = new Mail($to);
        $mail->setObject($object);
        $mail->setMessage($result);
        return $mail->send();
    }

}