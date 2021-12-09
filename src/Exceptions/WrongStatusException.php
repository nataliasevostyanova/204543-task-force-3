<?php

namespace TaskForce\Exceptions;

/**
 * Класс-исключение для проверки допустимого статуса в задании Task
 */
class WrongStatusException extends \Exception
{
    /**
     * @param string $message является обязательным
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
