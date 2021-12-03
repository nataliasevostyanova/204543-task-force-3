<?php

/**
 * Класс-исключение для проверки допустимого статуса в задании Task
 */
namespace TaskForce\Exceptions;

/**
 * @param string $message является обязательным
 */
class WrongStatusException extends \Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
}
