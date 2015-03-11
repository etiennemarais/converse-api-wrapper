<?php namespace ConverseApi\Exceptions;

class ConverseApiException extends \Exception
{
    public function __construct($code)
    {
        $message = 'Request to Converse API failed';
        parent::__construct($message, $code);
    }
}