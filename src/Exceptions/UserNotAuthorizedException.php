<?php namespace ConverseApi\Exceptions;

class UserNotAuthorizedException extends \Exception
{
    public function __construct()
    {
        $message = 'User not authorized';
        parent::__construct($message, 401);
    }
}