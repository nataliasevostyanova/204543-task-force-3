<?php

namespace TaskForce\Exceptions;

/**
 * Класс-исключение для проверки допустимого действия в задании Task
 */
class WrongActionException extends \Exception
{
    /**
     * @param string $message является обязательным
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
        $this->message = $message;
    }
}
