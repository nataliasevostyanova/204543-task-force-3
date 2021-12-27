<?php

namespace TaskForce\Exceptions;

use Exception;
/**
 * Класс-исключение для проверки существования файла в заданной директории
 */
class FileExistException extends Exception
{
    /**
     * @param string $message является обязательным
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
