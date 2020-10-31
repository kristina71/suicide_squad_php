<?php


class BadSumException extends Exception
{
    private $message;

    /**
     * @param $message
     */
    public function __construct($message)
    {
        Exception::__construct('Bad sum exception '.$message->oneLine);
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