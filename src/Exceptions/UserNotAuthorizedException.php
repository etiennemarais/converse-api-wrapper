<?php namespace ConverseApi\Exceptions;

class UserNotAuthorizedException extends \Exception
{
    public function __construct($resource)
    {
        $data = json_decode($resource->getContent());

        $message = $data->message;
        $code = $resource->getStatusCode();

        parent::__construct($message, $code);
    }
}