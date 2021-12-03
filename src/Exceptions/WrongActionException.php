<?php
/**
 * Класс-исключение для проверки допустимого действия в задании Task
 */
namespace TaskForce\Exceptions;

   /**
     * @param string $message является обязательным
     */
class WrongActionException extends \Exception
{
    public function __construct($message = null)
    {
        parent::__construct($message);
    }
}
