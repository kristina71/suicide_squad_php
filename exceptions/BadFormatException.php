<?php


class BadFormatException
{
    private $message;

    /**
     * @param $message
     */
    public function __construct($message)
    {
        Exception::__construct('Bad format exception '.$message->oneLine);
        $this->message = $message;
    }
    /**
     * @return String
     */
    public function getTextMessage()
    {
        return $this->message;
    }
}